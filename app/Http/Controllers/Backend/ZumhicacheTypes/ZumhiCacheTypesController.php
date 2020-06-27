<?php

namespace App\Http\Controllers\Backend\ZumhicacheTypes;

use App\Models\ZumhicacheTypes\ZumhiCacheType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheTypes\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheTypes\EditResponse;
use App\Repositories\Backend\ZumhicacheTypes\ZumhiCacheTypeRepository;
use App\Http\Requests\Backend\ZumhicacheTypes\ManageZumhiCacheTypeRequest;
use App\Http\Requests\Backend\ZumhicacheTypes\CreateZumhiCacheTypeRequest;
use App\Http\Requests\Backend\ZumhicacheTypes\StoreZumhiCacheTypeRequest;
use App\Http\Requests\Backend\ZumhicacheTypes\EditZumhiCacheTypeRequest;
use App\Http\Requests\Backend\ZumhicacheTypes\UpdateZumhiCacheTypeRequest;
use App\Http\Requests\Backend\ZumhicacheTypes\DeleteZumhiCacheTypeRequest;

/**
 * ZumhiCacheTypesController
 */
class ZumhiCacheTypesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheTypeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheTypeRepository $repository;
     */
    public function __construct(ZumhiCacheTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheTypes\ManageZumhiCacheTypeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheTypeRequest $request)
    {
        return new ViewResponse('backend.zumhicachetypes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheTypes\CreateResponse
     */
    public function create(CreateZumhiCacheTypeRequest $request)
    {
        return new CreateResponse('backend.zumhicachetypes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheTypeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheTypeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachetypes.index'), ['flash_success' => trans('alerts.backend.zumhicachetypes.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheTypes\ZumhiCacheType  $zumhicachetype
     * @param  EditZumhiCacheTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheTypes\EditResponse
     */
    public function edit(ZumhiCacheType $zumhicachetype, EditZumhiCacheTypeRequest $request)
    {
        return new EditResponse($zumhicachetype);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheTypeRequestNamespace  $request
     * @param  App\Models\ZumhicacheTypes\ZumhiCacheType  $zumhicachetype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheTypeRequest $request, ZumhiCacheType $zumhicachetype)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zumhicachetype, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachetypes.index'), ['flash_success' => trans('alerts.backend.zumhicachetypes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheTypeRequestNamespace  $request
     * @param  App\Models\ZumhicacheTypes\ZumhiCacheType  $zumhicachetype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZumhiCacheType $zumhicachetype, DeleteZumhiCacheTypeRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zumhicachetype);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicachetypes.index'), ['flash_success' => trans('alerts.backend.zumhicachetypes.deleted')]);
    }
    
}
