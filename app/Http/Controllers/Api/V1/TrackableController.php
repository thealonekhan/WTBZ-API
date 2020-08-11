<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\TrackableResource;
use App\Http\Resources\ZumhiCacheLogTypeResource;
use Illuminate\Http\Request;
use App\Models\Trackable\Trackable;
use App\Repositories\Backend\Trackable\TrackableRepository;
use App\Repositories\Backend\LogType\LogTypeRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class TrackableController extends APIController
{
    protected $repository;
    protected $logtyperepo;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(TrackableRepository $repository, LogTypeRepository $logtyperepo)
    {
        $this->repository = $repository;
        $this->logtyperepo = $logtyperepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  TrackableResource::collection(
            Trackable::with(['country', 'owner', 'holder', 'zumhicache', 'type'])
            //->where('zumhiCode', $referenceCode)
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
    public function zumhicacheTrackables(Request $request, $referenceCode)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  TrackableResource::collection(
            Trackable::with(['country', 'owner', 'holder', 'zumhicache', 'type'])
            ->where('zumhiCode', $referenceCode)
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
    public function zumhicointypes(Request $request)
    {
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  ZumhiCacheLogTypeResource::collection(
            $this->logtyperepo->getForDataTable()->take($take)->skip($skip)->get()
        );

        if ($request->get('sort')) {
            $collections = APIHelper::formatSort($request->get('sort'), $collections);
        }

        return $collections;
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

        $collections =  TrackableResource::collection(
            Trackable::with(['country', 'owner', 'holder', 'zumhicache', 'type'])
            ->where('referenceCode', $referenceCode)
            ->get()
        )->first();

        if ($fields && $lite == 'false') {
            $collections = $collections->only(APIHelper::formatRefCodes($fields));
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
