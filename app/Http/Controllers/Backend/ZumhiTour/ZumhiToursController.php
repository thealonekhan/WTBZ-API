<?php

namespace App\Http\Controllers\Backend\ZumhiTour;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhiTour\CreateResponse;
use App\Http\Responses\Backend\ZumhiTour\EditResponse;
use App\Http\Responses\Backend\ZumhiTour\ShowResponse;
use App\Repositories\Backend\ZumhiTour\ZumhiTourRepository;
use App\Http\Requests\Backend\ZumhiTour\ManageZumhiTourRequest;
use App\Http\Requests\Backend\ZumhiTour\CreateZumhiTourRequest;
use App\Http\Requests\Backend\ZumhiTour\StoreZumhiTourRequest;
use App\Http\Requests\Backend\ZumhiTour\EditZumhiTourRequest;
use App\Http\Requests\Backend\ZumhiTour\UpdateZumhiTourRequest;
use App\Http\Requests\Backend\ZumhiTour\DeleteZumhiTourRequest;
use App\Models\ZumhiTour\ZumhiTour;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\Sponsor\Sponsor;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;

/**
 * ZumhiToursController
 */
class ZumhiToursController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiTourRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiTourRepository $repository;
     */
    public function __construct(ZumhiTourRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhiTour\ManageZumhiTourRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiTourRequest $request)
    {
        return new ViewResponse('backend.zumhitours.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiTourRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhiTour\CreateResponse
     */
    public function create(CreateZumhiTourRequest $request)
    {
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');
        $zumhicaches = ZumhiCache::get()->pluck('full_name', 'id');
        $sponsors = Sponsor::getSelectData();
        return new CreateResponse($coordinates, $zumhicaches, $sponsors);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiTourRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiTourRequest $request)
    {
        //Create the model using repository create method
        $this->repository->create($request->except('_token'));
        //return with successfull message
        return new RedirectResponse(route('admin.zumhitours.index'), ['flash_success' => trans('alerts.backend.zumhitours.created')]);
    }
    /**
     * @param App\Models\ZumhiTour\ZumhiTour  $zumhitour
     * @return \App\Http\Responses\Backend\ZumhiTour\ShowResponse
     */
    public function show($id)
    {
        $zumhitour = ZumhiTour::findOrFail($id);
        return new ShowResponse($zumhitour);
    } 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhiTour\ZumhiTour  $zumhitour
     * @param  EditZumhiTourRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhiTour\EditResponse
     */
    public function edit($id)
    {
        $zumhitour = ZumhiTour::findOrFail($id);
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');
        $zumhicaches = ZumhiCache::get()->pluck('full_name', 'id');
        $sponsors = Sponsor::getSelectData();
        return new EditResponse($zumhitour, $coordinates, $zumhicaches, $sponsors);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiTourRequestNamespace  $request
     * @param  App\Models\ZumhiTour\ZumhiTour  $zumhitour
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiTourRequest $request, $id)
    {
        //Input received from the request
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhitours.index'), ['flash_success' => trans('alerts.backend.zumhitours.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiTourRequestNamespace  $request
     * @param  App\Models\ZumhiTour\ZumhiTour  $zumhitour
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteZumhiTourRequest $request, $id)
    {
        $zumhitour = ZumhiTour::find($id);
        //Calling the delete method on repository
        $this->repository->delete($zumhitour);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhitours.index'), ['flash_success' => trans('alerts.backend.zumhitours.deleted')]);
    }
    
}
