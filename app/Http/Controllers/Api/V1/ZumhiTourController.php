<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiTourResource;
use App\Http\Resources\ZumhiCacheResource;
use Illuminate\Http\Request;
use App\Models\ZumhiTour\ZumhiTour;
use App\Models\Zumhicache\ZumhiCache;
use App\Repositories\Backend\ZumhiTour\ZumhiTourRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ZumhiTourController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZumhiTourRepository $repository)
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

        $collections =  ZumhiTourResource::collection(
            ZumhiTour::with(['zumhicaches', 'coordinates', 'sponsor'])
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
    public function zumhicaches($referenceCode, Request $request)
    {
        $validation = Validator::make(['referenceCode' => $referenceCode], [
            'referenceCode' => 'required|exists:zumhitours,referenceCode'
        ]);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $lite = $request->get('lite') ? $request->get('lite') : 'false';
        $fields = $request->get('fields') ? $request->get('fields') : null;

        $zumhitour = ZumhiTour::where('referenceCode', $referenceCode)->first();
        $zumhiCodes = $zumhitour->zumhicaches->pluck('referenceCode');

        $collections =  ZumhiCacheResource::collection(
            ZumhiCache::with(['owner', 'owner.owner', 'owner.membership', 'type', 'size', 'country', 'state', 'coordinate'])
            ->whereIn('referenceCode', $zumhiCodes)
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

        $collections =  ZumhiTourResource::collection(
            ZumhiTour::with(['zumhicaches', 'coordinates', 'sponsor'])
            ->where('referenceCode', $referenceCode)
            ->get()
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
