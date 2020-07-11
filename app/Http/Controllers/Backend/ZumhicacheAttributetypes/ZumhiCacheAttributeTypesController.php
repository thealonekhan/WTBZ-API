<?php

namespace App\Http\Controllers\Backend\ZumhicacheAttributetypes;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheAttributetypes\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheAttributetypes\EditResponse;
use App\Http\Responses\Backend\ZumhicacheAttributetypes\ShowResponse;
use App\Repositories\Backend\ZumhicacheAttributetypes\ZumhiCacheAttributeTypeRepository;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\ManageZumhiCacheAttributeTypeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\CreateZumhiCacheAttributeTypeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\StoreZumhiCacheAttributeTypeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\EditZumhiCacheAttributeTypeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\UpdateZumhiCacheAttributeTypeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\DeleteZumhiCacheAttributeTypeRequest;
use App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType;
use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;

/**
 * ZumhiCacheAttributeTypesController
 */
class ZumhiCacheAttributeTypesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheAttributeTypeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheAttributeTypeRepository $repository;
     */
    public function __construct(ZumhiCacheAttributeTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheAttributetypes\ManageZumhiCacheAttributeTypeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheAttributeTypeRequest $request)
    {
        return new ViewResponse('backend.zumhicacheattributetypes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheAttributeTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheAttributetypes\CreateResponse
     */
    public function create(CreateZumhiCacheAttributeTypeRequest $request)
    {
        $attributes = ZumhiCacheAttribute::pluck('name', 'id');
        return new CreateResponse($attributes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheAttributeTypeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheAttributeTypeRequest $request)
    {
        //Create the model using repository create method
        $this->repository->create($request->except('_token'));
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributetypes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributetypes.created')]);
    }
    /**
     * @param App\Models\ZumhicacheAttributeTypes\ZumhiCacheAttributeType  $zumhicacheattributetype
     * @return \App\Http\Responses\Backend\ZumhicacheAttributeTypes\ShowResponse
     */
    public function show($id)
    {
        $zumhicacheattributetype = ZumhiCacheAttributeType::findOrFail($id);
        return new ShowResponse($zumhicacheattributetype);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType  $zumhicacheattributetype
     * @param  EditZumhiCacheAttributeTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheAttributetypes\EditResponse
     */
    public function edit($id)
    {
        $zumhicacheattributetype = ZumhiCacheAttributeType::findOrFail($id);
        $attributes = ZumhiCacheAttribute::pluck('name', 'id');
        return new EditResponse($zumhicacheattributetype, $attributes);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheAttributeTypeRequestNamespace  $request
     * @param  App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType  $zumhicacheattributetype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheAttributeTypeRequest $request, $id)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributetypes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributetypes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheAttributeTypeRequestNamespace  $request
     * @param  App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType  $zumhicacheattributetype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteZumhiCacheAttributeTypeRequest $request, $id)
    {
        $zumhicacheattributetype = ZumhiCacheAttributeType::find($id);
        //Calling the delete method on repository
        $this->repository->delete($zumhicacheattributetype);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributetypes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributetypes.deleted')]);
    }
    
}
