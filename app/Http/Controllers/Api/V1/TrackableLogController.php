<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\TrackableLogResource;
use Illuminate\Http\Request;
use App\Models\TrackableLog\TrackableLog;
use App\Repositories\Backend\TrackableLog\TrackableLogRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TrackableLogController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(TrackableLogRepository $repository)
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

        $collections =  TrackableLogResource::collection(
            TrackableLog::with(['trackable', 'owner', 'zumhicache', 'trackableLogType', 'coordinate'])
            ->where('trackableCode', $referenceCode)
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

        return new TrackableLogResource(TrackableLog::orderBy('created_at', 'desc')->first());
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

        $collections =  TrackableLogResource::collection(
            TrackableLog::with(['trackable', 'owner', 'zumhicache', 'trackableLogType', 'coordinate'])
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
        $trackablelog = TrackableLog::where('referenceCode', $referenceCode)->first();

        if ($trackablelog) {
            $validation = $this->validateLog($request, 'update', $trackablelog->id);

            if ($validation->fails()) {
                return $this->throwValidation($validation->messages()->first());
            }

            $this->repository->update($trackablelog->id, $request->all());


            return new TrackableLogResource(TrackableLog::findOrFail($trackablelog->id));
        }

        return $this->respond([
            'message' => trans('exceptions.backend.trackablelogs.update_error'),
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
        $trackablelog = TrackableLog::where('referenceCode', $referenceCode)->first();
        if ($trackablelog) {
            $this->repository->delete($trackablelog);
            return $this->respond([
                'message' => trans('alerts.backend.trackablelogs.deleted'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.trackablelogs.delete_error'),
        ]);
    }

    /**
     * validate TrackableLog.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateLog(Request $request, $action = 'insert', $trackablelogID=null)
    {
        $referenceCode = '';
        if ($action == 'insert') {
            $referenceCode = 'required|max:36|unique:trackablelogs';
        }
        if ($action == 'update') {
            $referenceCode = [
                'required',
                'max:36',
                Rule::unique('trackablelogs')->ignore($trackablelogID),
            ];
        }



        $validation = Validator::make($request->all(), [
            'referenceCode'     => $referenceCode,
            'ownerCode'         => 'required|exists:zumhicacheusers,referenceCode',
            'trackableCode'     => 'required|exists:trackables,referenceCode',
            'zumhicacheCode'    => 'required|exists:zumhi_caches,referenceCode',
            'logDate'           => 'required|date',
            'isRot13Encoded'    => 'nullable|boolean',
            'trackableLogTypeId'=> 'required|integer|exists:trackablelogtypes,id',
            'coordinates_id'    => 'nullable|integer|exists:zumhicachecoordinates,id',
            'trackingNumber'    => 'nullable|integer',
            'url'               => 'nullable|url',
        ]);

        return $validation;

    }
}
