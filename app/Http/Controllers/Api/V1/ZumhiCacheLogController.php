<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiCacheLogResource;
use Illuminate\Http\Request;
use App\Models\ZumhicacheLog\ZumhiCacheLog;
use App\Repositories\Backend\ZumhicacheLog\ZumhiCacheLogRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ZumhiCacheLogController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZumhiCacheLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $referenceCode)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  ZumhiCacheLogResource::collection(
            ZumhiCacheLog::with(['owner', 'zumhicache', 'logType', 'coordinate'])
            ->where('zumhicacheCode', $referenceCode)
            ->take($take)
            ->skip($skip)
            ->get()
        );

        if ($fields) {
            $collections = $collections->map->only(APIHelper::formatRefCodes($fields));
        }

        return $collections;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validateLog($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        // dd($request->all());
        $this->repository->create($request->all());

        return new ZumhiCacheLogResource(ZumhiCacheLog::orderBy('created_at', 'desc')->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($referenceCode)
    {
        // $lite = request()->lite ? request()->lite : 'false';
        $fields = request()->fields ? request()->fields : null;

        $collections =  ZumhiCacheLogResource::collection(
            ZumhiCacheLog::with(['owner', 'zumhicache', 'logType', 'coordinate'])
            ->where('referenceCode', $referenceCode)
            ->get()
        )->first();

        if ($fields) {
            $collections = $collections->only(APIHelper::formatRefCodes($fields));
        }

        return $collections;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $referenceCode)
    {
        $zumhicachelog = ZumhiCacheLog::where('referenceCode', $referenceCode)->first();

        if ($zumhicachelog) {
            $validation = $this->validateLog($request, 'update', $zumhicachelog->id);

            if ($validation->fails()) {
                return $this->throwValidation($validation->messages()->first());
            }

            $this->repository->update($zumhicachelog->id, $request->all());


            return new ZumhiCacheLogResource(ZumhiCacheLog::findOrFail($zumhicachelog->id));
        }

        return $this->respond([
            'message' => trans('exceptions.backend.zumhicachelogs.update_error'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($referenceCode)
    {
        $zumhicachelog = ZumhiCacheLog::where('referenceCode', $referenceCode)->first();
        if ($zumhicachelog) {
            $this->repository->delete($zumhicachelog);
            return $this->respond([
                'message' => trans('alerts.backend.zumhicachelogs.deleted'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.zumhicachelogs.delete_error'),
        ]);
    }

    /**
     * validate ZumhiCacheLog.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateLog(Request $request, $action = 'insert', $zumhicachelogID=null)
    {
        $referenceCode = '';
        if ($action == 'insert') {
            $referenceCode = 'required|max:36|unique:zumhicachelogs';
        }
        if ($action == 'update') {
            $referenceCode = [
                'required',
                'max:36',
                Rule::unique('zumhicachelogs')->ignore($zumhicachelogID),
            ];
        }



        $validation = Validator::make($request->all(), [
            'referenceCode'     => $referenceCode,
            'ownerCode'         => 'required|exists:zumhicacheusers,referenceCode',
            'zumhicacheCode'    => 'required|exists:zumhi_caches,referenceCode',
            'loggedDate'        => 'required|date',
            'logtype_id'        => 'required|integer|exists:logtypes,id',
            'coordinates_id'    => 'nullable|integer|exists:zumhicachecoordinates,id',
            'usedFavoritePoint' => 'nullable|boolean',
            'isEncoded'         => 'nullable|boolean',
            'isArchived'        => 'nullable|boolean',
            'url'               => 'nullable|url',
        ]);

        return $validation;

    }
}
