<?php

namespace App\Http\Controllers\Backend\ZumhicacheAttributes;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheAttributes\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheAttributes\EditResponse;
use App\Http\Responses\Backend\ZumhicacheAttributes\ShowResponse;
use App\Repositories\Backend\ZumhicacheAttributes\ZumhiCacheAttributeRepository;
use App\Http\Requests\Backend\ZumhicacheAttributes\ManageZumhiCacheAttributeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributes\CreateZumhiCacheAttributeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributes\StoreZumhiCacheAttributeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributes\EditZumhiCacheAttributeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributes\UpdateZumhiCacheAttributeRequest;
use App\Http\Requests\Backend\ZumhicacheAttributes\DeleteZumhiCacheAttributeRequest;
use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;

/**
 * ZumhiCacheAttributesController
 */
class ZumhiCacheAttributesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheAttributeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheAttributeRepository $repository;
     */
    public function __construct(ZumhiCacheAttributeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheAttributes\ManageZumhiCacheAttributeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheAttributeRequest $request)
    {
        return new ViewResponse('backend.zumhicacheattributes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheAttributeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheAttributes\CreateResponse
     */
    public function create(CreateZumhiCacheAttributeRequest $request)
    {
        return new CreateResponse('backend.zumhicacheattributes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheAttributeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheAttributeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributes.created')]);
    }
    /**
     * @param App\Models\ZumhicacheAttributes\ZumhiCacheAttribute  $zumhicacheattribute
     * @return \App\Http\Responses\Backend\ZumhicacheAttributes\ShowResponse
     */
    public function show($id)
    {
        $zumhicacheattribute = ZumhiCacheAttribute::findOrFail($id);
        return new ShowResponse($zumhicacheattribute);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheAttributes\ZumhiCacheAttribute  $zumhicacheattribute
     * @param  EditZumhiCacheAttributeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheAttributes\EditResponse
     */
    public function edit($id)
    {   
        $zumhicacheattribute = ZumhiCacheAttribute::findOrFail($id);
        return new EditResponse($zumhicacheattribute);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheAttributeRequestNamespace  $request
     * @param  App\Models\ZumhicacheAttributes\ZumhiCacheAttribute  $zumhicacheattribute
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheAttributeRequest $request, $id)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheAttributeRequestNamespace  $request
     * @param  App\Models\ZumhicacheAttributes\ZumhiCacheAttribute  $zumhicacheattribute
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteZumhiCacheAttributeRequest $request, $id)
    {
        $zumhicacheattribute = ZumhiCacheAttribute::find($id);
        //Calling the delete method on repository
        $this->repository->delete($zumhicacheattribute);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicacheattributes.index'), ['flash_success' => trans('alerts.backend.zumhicacheattributes.deleted')]);
    }
    
}
