<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiCacheResource;
use Illuminate\Http\Request;
use App\Models\Zumhicache\ZumhiCache;
use App\Repositories\Backend\Zumhicache\ZumhiCacheRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ZumhiCacheController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZumhiCacheRepository $repository)
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

        $validation = $this->validateZumhiCache($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $referenceCodes = APIHelper::formatRefCodes($request->get('referenceCodes'));
        $lite = $request->get('lite') ? $request->get('lite') : 'false';
        $fields = $request->get('fields') ? $request->get('fields') : null;

        $collections =  ZumhiCacheResource::collection(
            ZumhiCache::with(['owner', 'owner.owner', 'owner.membership', 'type', 'size', 'country', 'state', 'coordinate'])
            ->whereIn('referenceCode', $referenceCodes)
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

        $collections =  ZumhiCacheResource::collection(
            ZumhiCache::with(['owner', 'owner.owner', 'owner.membership', 'type', 'size', 'country', 'state', 'coordinate'])
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


    /**
     * Search ZumhiCache resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $validation = $this->validateZumhiCache($request);
        // if ($validation->fails()) {
        //     return $this->throwValidation($validation->messages()->first());
        // }
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;
        $sort = $request->get('sort') ? $request->get('sort') : null;
        $lite = $request->get('lite') ? $request->get('lite') : 'false';
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $location = $request->get('loc') ? APIHelper::formatCoordinates($request->get('loc')) : null;
        $radius = $request->get('radius') ? $request->get('radius') : "100mi";
        $box = $request->get('box') ? APIHelper::formatMultiCoordinates($request->get('box')) : null;
        $type = $request->get('type') ? APIHelper::formatDelimmiter($request->get('type')) : null;
        $codes = $request->get('codes') ? APIHelper::formatDelimmiter($request->get('codes')) : null;
        $difficulty = $request->get('diff') ? APIHelper::formatRange($request->get('diff')) : null;
        $terrain = $request->get('terr') ? APIHelper::formatRange($request->get('terr')) : null;
        $size = $request->get('size') ? APIHelper::formatDelimmiter($request->get('size')) : null;
        $name = $request->get('name') ? $request->get('name') : null;
        $state = $request->get('st') ? $request->get('st') : null;
        $country = $request->get('co') ? $request->get('co') : null;
        $membership = $request->get('lvl') ? $request->get('lvl') : 2;
        $publishedDate = $request->get('pd') ? APIHelper::formatDelimmiter($request->get('pd')) : null;
        $status = $request->get('status') ? $request->get('status') : null;

        // Search Query Starts
        $zumhiCacheQuery = ZumhiCache::with(['owner', 'owner.owner', 'owner.membership', 'type', 'size', 'country', 'state', 'coordinate']);
        
        if ($country) {
            $zumhiCacheQuery->where('country_id',  $country);
        }
        if ($state) {
            $zumhiCacheQuery->where('state_id',  $state);
        }

        if ($status) {
            $zumhiCacheQuery->where('status_id',  $status);
        }

        if ($name) {
            $zumhiCacheQuery->where('name',  'like', '%' . $name . '%');
        }

        if ($size) {
            if (Arr::has($size, 'exclude')) {
                $zumhiCacheQuery->whereNotIn('size_id',  $size['exclude']);
            } else {
                $zumhiCacheQuery->whereIn('size_id',  $size);
            }
        }

        if ($type) {
            if (Arr::has($type, 'exclude')) {
                $zumhiCacheQuery->whereNotIn('type_id',  $type['exclude']);
            } else {
                $zumhiCacheQuery->whereIn('type_id',  $type);
            }
        }

        if ($codes) {
            if (Arr::has($codes, 'exclude')) {
                $zumhiCacheQuery->whereNotIn('referenceCode',  $codes['exclude']);
            } else {
                $zumhiCacheQuery->whereIn('referenceCode',  $codes);
            }
        }

        if (empty($box) && !empty($location)) {

            $string = "SELECT id, latitude, longitude, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance FROM zumhicachecoordinates HAVING distance < ? ORDER BY distance;";
            $args = [$location['latitude'], $location['longitude'], $location['latitude'], $radius];
    
            $data = DB::select($string, $args);
            $coordinate_ids = [];
            if (!empty($data)) {
                foreach ($data as $dt) {
                    $coordinate_ids[] = $dt->id;
                }
            }
            $zumhiCacheQuery->whereIn('coordinates_id', $coordinate_ids);
        }

        if (!empty($box)) {
            
            $sqlDistance = DB::raw('( 111.045 * acos( cos( radians(' . $box['end']['latitude'] . ') ) 
            * cos( radians( '.$box['start']['latitude'].' ) ) 
            * cos( radians( '.$box['start']['longitude'].' ) 
            - radians(' . $box['end']['longitude']  . ') ) 
            + sin( radians(' . $box['end']['latitude']  . ') ) 
            * sin( radians( '.$box['start']['latitude'].' ) ) ) )');

            $coordinate_ids =  DB::table('zumhicachecoordinates')
            ->selectRaw("{$sqlDistance} AS distance, id")
            ->pluck('id');

            $zumhiCacheQuery->whereIn('coordinates_id', $coordinate_ids);
        }



        if ($difficulty) {
            $zumhiCacheQuery->whereBetween('difficulty',  $difficulty);
        }

        if ($terrain) {
            $zumhiCacheQuery->whereBetween('terrain',  $terrain);
        }

        if ($publishedDate) {
            $startDate = Carbon::parse($publishedDate[0])->toDateString();
            $endDate = Carbon::parse($publishedDate[1])->toDateString();
            $zumhiCacheQuery->whereBetween('publishedDate',  [$startDate." 00:00:00", $endDate." 23:59:59"]);
        }
        if ($membership) {
            $zumhiCacheQuery->whereHas('owner.membership', function ($query) use ($membership) {
                $query->where('id',  $membership);
            });
        }

        $zumhiCacheQuery = $zumhiCacheQuery->take($take)->skip($skip)->get();

        $collections =  ZumhiCacheResource::collection(
            $zumhiCacheQuery
        );

        if ($fields && $lite == 'false') {
            $collections = $collections->map->only(APIHelper::formatRefCodes($fields));
        }

        if ($sort) {
            $collections = APIHelper::formatSort($sort, $collections);
        }

        return $collections;
    }

    /**
     * validate ZumhiCache.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateZumhiCache(Request $request, $action = 'get-all')
    {

        if ($action == 'get-all') {
            $validation = Validator::make($request->all(), [
                'referenceCodes'    => 'required'
            ]);   
            return $validation;
        }

    }
}
