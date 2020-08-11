<?php

namespace App\Http\Controllers\Backend\TrackableLogType;

use App\Models\TrackableLogType\TrackableLogType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\TrackableLogType\CreateResponse;
use App\Http\Responses\Backend\TrackableLogType\EditResponse;
use App\Repositories\Backend\TrackableLogType\TrackableLogTypeRepository;
use App\Http\Requests\Backend\TrackableLogType\ManageTrackableLogTypeRequest;
use App\Http\Requests\Backend\TrackableLogType\CreateTrackableLogTypeRequest;
use App\Http\Requests\Backend\TrackableLogType\StoreTrackableLogTypeRequest;
use App\Http\Requests\Backend\TrackableLogType\EditTrackableLogTypeRequest;
use App\Http\Requests\Backend\TrackableLogType\UpdateTrackableLogTypeRequest;
use App\Http\Requests\Backend\TrackableLogType\DeleteTrackableLogTypeRequest;

/**
 * TrackableLogTypesController
 */
class TrackableLogTypesController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableLogTypeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param TrackableLogTypeRepository $repository;
     */
    public function __construct(TrackableLogTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\TrackableLogType\ManageTrackableLogTypeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTrackableLogTypeRequest $request)
    {
        return new ViewResponse('backend.trackablelogtypes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateTrackableLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\TrackableLogType\CreateResponse
     */
    public function create(CreateTrackableLogTypeRequest $request)
    {
        return new CreateResponse('backend.trackablelogtypes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTrackableLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreTrackableLogTypeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.trackablelogtypes.index'), ['flash_success' => trans('alerts.backend.trackablelogtypes.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TrackableLogType\TrackableLogType  $trackablelogtype
     * @param  EditTrackableLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\TrackableLogType\EditResponse
     */
    public function edit(TrackableLogType $trackablelogtype, EditTrackableLogTypeRequest $request)
    {
        return new EditResponse($trackablelogtype);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTrackableLogTypeRequestNamespace  $request
     * @param  App\Models\TrackableLogType\TrackableLogType  $trackablelogtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateTrackableLogTypeRequest $request, TrackableLogType $trackablelogtype)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $trackablelogtype, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.trackablelogtypes.index'), ['flash_success' => trans('alerts.backend.trackablelogtypes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteTrackableLogTypeRequestNamespace  $request
     * @param  App\Models\TrackableLogType\TrackableLogType  $trackablelogtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(TrackableLogType $trackablelogtype, DeleteTrackableLogTypeRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($trackablelogtype);
        //returning with successfull message
        return new RedirectResponse(route('admin.trackablelogtypes.index'), ['flash_success' => trans('alerts.backend.trackablelogtypes.deleted')]);
    }
    
}
