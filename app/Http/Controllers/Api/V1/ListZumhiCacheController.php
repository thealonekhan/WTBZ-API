<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiCacheResource;
use App\Http\Resources\ListZumhiCacheResource;
use Illuminate\Http\Request;
use App\Models\ListZumhiCache\ListZumhiCache;
use App\Models\Zumhicache\ZumhiCache;
use App\Repositories\Backend\ListZumhiCache\ListZumhiCacheRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ListZumhiCacheController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ListZumhiCacheRepository $repository)
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
        $lite = $request->get('lite') ? $request->get('lite') : 'false';
        $take = $request->get('take') ? $request->get('take') : 100;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $zumhicodes = ListZumhiCache::where('listCode', $referenceCode)
        ->get()
        ->pluck('zumhiCode');

        $collections =  ZumhiCacheResource::collection(
            ZumhiCache::with(['owner', 'owner.owner', 'owner.membership', 'type', 'size', 'country', 'state', 'coordinate'])
            ->whereIn('referenceCode', $zumhicodes)
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
        $validation = $this->validateListZumhiCache($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $this->repository->create($request->all());

        return new ListZumhiCacheResource(ListZumhiCache::orderBy('created_at', 'desc')->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($referenceCode)
    // {
    //     // $lite = request()->lite ? request()->lite : 'false';
    //     $fields = request()->fields ? request()->fields : null;

    //     $collections =  ZumhiCacheResource::collection(
    //         ZCList::with(['owner', 'listtype'])
    //         ->where('referenceCode', $referenceCode)
    //         ->get()
    //     )->first();

    //     if ($fields) {
    //         $collections = $collections->only(APIHelper::formatRefCodes($fields));
    //     }

    //     return $collections;
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $referenceCode)
    // {
    //     $zclist = ZCList::where('referenceCode', $referenceCode)->first();

    //     if ($zclist) {
    //         $validation = $this->validateListZumhiCache($request, 'update', $zclist->id);

    //         if ($validation->fails()) {
    //             return $this->throwValidation($validation->messages()->first());
    //         }

    //         $this->repository->update($zclist->id, $request->all());


    //         return new ZumhiCacheResource(ZCList::findOrFail($zclist->id));
    //     }

    //     return $this->respond([
    //         'message' => trans('exceptions.backend.zclists.update_error'),
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($listCode, $zumhiCode)
    {
        $listzumhicache = ListZumhiCache::where('listCode', $listCode)
        ->where('zumhiCode', $zumhiCode)
        ->first();
        if ($listzumhicache) {
            $this->repository->delete($listzumhicache);
            return $this->respond([
                'message' => trans('alerts.backend.listzumhicaches.deleted'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.listzumhicaches.delete_error'),
        ]);
    }

    /**
     * validate List.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateListZumhiCache(Request $request, $action = 'insert', $listID=null)
    {

        $validation = Validator::make($request->all(), [
            'listItemName'          => 'required',
            'listCode'              => 'required|exists:lists,referenceCode',
            'zumhiCode'             => 'required|exists:zumhi_caches,referenceCode',
        ]);

        return $validation;

    }
}
