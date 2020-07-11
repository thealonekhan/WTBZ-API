<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZumhiCacheAttributeTypeResource;
use Illuminate\Http\Request;
use App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType;
use App\Repositories\Backend\ZumhicacheAttributetypes\ZumhiCacheAttributeTypeRepository;
use App\Helpers\APIHelper;
use Validator;

class ZumhiCacheAttributeTypeController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZumhiCacheAttributeTypeRepository $repository)
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
        $take = $request->get('take') ? $request->get('take') : 100;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  ZumhiCacheAttributeTypeResource::collection(
            ZumhiCacheAttributeType::take($take)->skip($skip)->get()
        );

        if ($request->get('sort')) {
            $collections = APIHelper::formatSort($request->get('sort'), $collections);
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
    public function show($id)
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
