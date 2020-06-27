<?php

namespace App\Http\Controllers\Backend\ZumhicacheCoordinates;

use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheCoordinates\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheCoordinates\EditResponse;
use App\Repositories\Backend\ZumhicacheCoordinates\ZumhiCacheCoordinateRepository;
use App\Http\Requests\Backend\ZumhicacheCoordinates\ManageZumhiCacheCoordinateRequest;
use App\Http\Requests\Backend\ZumhicacheCoordinates\CreateZumhiCacheCoordinateRequest;
use App\Http\Requests\Backend\ZumhicacheCoordinates\StoreZumhiCacheCoordinateRequest;
use App\Http\Requests\Backend\ZumhicacheCoordinates\EditZumhiCacheCoordinateRequest;
use App\Http\Requests\Backend\ZumhicacheCoordinates\UpdateZumhiCacheCoordinateRequest;
use App\Http\Requests\Backend\ZumhicacheCoordinates\DeleteZumhiCacheCoordinateRequest;

/**
 * ZumhiCacheCoordinatesController
 */
class ZumhiCacheCoordinatesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheCoordinateRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheCoordinateRepository $repository;
     */
    public function __construct(ZumhiCacheCoordinateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheCoordinates\ManageZumhiCacheCoordinateRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheCoordinateRequest $request)
    {
        return new ViewResponse('backend.zumhicachecoordinates.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheCoordinateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheCoordinates\CreateResponse
     */
    public function create(CreateZumhiCacheCoordinateRequest $request)
    {
        return new CreateResponse('backend.zumhicachecoordinates.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheCoordinateRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheCoordinateRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachecoordinates.index'), ['flash_success' => trans('alerts.backend.zumhicachecoordinates.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate  $zumhicachecoordinate
     * @param  EditZumhiCacheCoordinateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheCoordinates\EditResponse
     */
    public function edit(ZumhiCacheCoordinate $zumhicachecoordinate, EditZumhiCacheCoordinateRequest $request)
    {
        return new EditResponse($zumhicachecoordinate);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheCoordinateRequestNamespace  $request
     * @param  App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate  $zumhicachecoordinate
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheCoordinateRequest $request, ZumhiCacheCoordinate $zumhicachecoordinate)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zumhicachecoordinate, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachecoordinates.index'), ['flash_success' => trans('alerts.backend.zumhicachecoordinates.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheCoordinateRequestNamespace  $request
     * @param  App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate  $zumhicachecoordinate
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZumhiCacheCoordinate $zumhicachecoordinate, DeleteZumhiCacheCoordinateRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zumhicachecoordinate);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicachecoordinates.index'), ['flash_success' => trans('alerts.backend.zumhicachecoordinates.deleted')]);
    }
    
}
