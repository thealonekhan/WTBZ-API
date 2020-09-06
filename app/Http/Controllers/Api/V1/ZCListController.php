<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ZCListResource;
use Illuminate\Http\Request;
use App\Models\ZCList\ZCList;
use App\Repositories\Backend\ZCList\ZCListRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ZCListController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(ZCListRepository $repository)
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
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  ZCListResource::collection(
            ZCList::with(['owner', 'listtype', 'listzumhicache'])
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
        $validation = $this->validateList($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $this->repository->create($request->all());

        return new ZCListResource(ZCList::orderBy('created_at', 'desc')->first());
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

        $collections =  ZCListResource::collection(
            ZCList::with(['owner', 'listtype', 'listzumhicache'])
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
        $zclist = ZCList::where('referenceCode', $referenceCode)->first();

        if ($zclist) {
            $validation = $this->validateList($request, 'update', $zclist->id);

            if ($validation->fails()) {
                return $this->throwValidation($validation->messages()->first());
            }

            $this->repository->update($zclist->id, $request->all());


            return new ZCListResource(ZCList::findOrFail($zclist->id));
        }

        return $this->respond([
            'message' => trans('exceptions.backend.zclists.update_error'),
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
        $zclist = ZCList::where('referenceCode', $referenceCode)->first();
        if ($zclist) {
            $this->repository->delete($zclist);
            return $this->respond([
                'message' => trans('alerts.backend.zclists.deleted'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.zclists.delete_error'),
        ]);
    }

    /**
     * validate List.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateList(Request $request, $action = 'insert', $listID=null)
    {
        $referenceCode = '';
        if ($action == 'insert') {
            $referenceCode = 'required|max:36|unique:lists';
        }
        if ($action == 'update') {
            $referenceCode = [
                'required',
                'max:36',
                Rule::unique('lists')->ignore($listID),
            ];
        }



        $validation = Validator::make($request->all(), [
            'referenceCode'         => $referenceCode,
            'createdDateUtc'        => 'nullable|date',
            'lastUpdatedDateUtc'    => 'nullable|date',
            'name'                  => 'required',
            'ownerCode'             => 'required|exists:zumhicacheusers,referenceCode',
            'description'           => 'nullable',
            'typeId'                => 'required|integer|exists:listtypes,id',
            'isShared'              => 'nullable|boolean',
            'isPublic'              => 'nullable|boolean',
            'url'                   => 'nullable|url',
        ]);

        return $validation;

    }
}
