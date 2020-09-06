<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiCacheUserResource;
use App\Http\Resources\ZumhiCacheLogResource;
use Illuminate\Http\Request;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\ZumhicacheLog\ZumhiCacheLog;
use App\Repositories\Backend\ZumhicacheUser\ZumhiCacheUserRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ZumhiCacheUserController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZumhiCacheUserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 100;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  ZumhiCacheUserResource::collection(
            ZumhiCacheUser::with(['owner', 'coordinate', 'membership'])
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zumhicachelogs($referenceCode, Request $request)
    {
        $validation = Validator::make(['referenceCode' => $referenceCode], [
            'referenceCode' => 'required|exists:zumhicacheusers,referenceCode'
        ]);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $lite = $request->get('lite') ? $request->get('lite') : 'false';
        $fields = $request->get('fields') ? $request->get('fields') : null;

        $collections =  ZumhiCacheLogResource::collection(
            ZumhiCacheLog::with(['owner', 'zumhicache', 'logType', 'coordinate'])
            ->where('ownerCode', $referenceCode)
            ->get()
        );

        if ($fields && $lite == 'false') {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($referenceCode)
    {
        $lite = request()->lite ? request()->lite : 'false';
        $fields = request()->fields ? request()->fields : null;

        if (strtolower($referenceCode) == 'me') {
            
            $zumhiuser = ZumhiCacheUser::with(['owner', 'coordinate', 'membership'])
            ->where('user_id', request()->user()->id)
            ->get();
        } else {
            $zumhiuser = ZumhiCacheUser::with(['owner', 'coordinate', 'membership'])
            ->where('referenceCode', $referenceCode)
            ->get();
        }

        $collections =  ZumhiCacheUserResource::collection(
            $zumhiuser
        )->first();

        if ($fields && $lite == 'false') {
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
