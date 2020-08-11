<?php

namespace App\Http\Controllers\Backend\TrackableLog;

use App\Models\TrackableLog\TrackableLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\TrackableLog\CreateResponse;
use App\Http\Responses\Backend\TrackableLog\EditResponse;
use App\Http\Responses\Backend\TrackableLog\ShowResponse;
use App\Repositories\Backend\TrackableLog\TrackableLogRepository;
use App\Http\Requests\Backend\TrackableLog\ManageTrackableLogRequest;
use App\Http\Requests\Backend\TrackableLog\CreateTrackableLogRequest;
use App\Http\Requests\Backend\TrackableLog\StoreTrackableLogRequest;
use App\Http\Requests\Backend\TrackableLog\EditTrackableLogRequest;
use App\Http\Requests\Backend\TrackableLog\UpdateTrackableLogRequest;
use App\Http\Requests\Backend\TrackableLog\DeleteTrackableLogRequest;

/**
 * TrackableLogsController
 */
class TrackableLogsController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableLogRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param TrackableLogRepository $repository;
     */
    public function __construct(TrackableLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\TrackableLog\ManageTrackableLogRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTrackableLogRequest $request)
    {
        return new ViewResponse('backend.trackablelogs.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateTrackableLogRequestNamespace  $request
     * @return \App\Http\Responses\Backend\TrackableLog\CreateResponse
     */
    public function create(CreateTrackableLogRequest $request)
    {
        return new CreateResponse('backend.trackablelogs.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTrackableLogRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreTrackableLogRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.trackablelogs.index'), ['flash_success' => trans('alerts.backend.trackablelogs.created')]);
    }
    /**
     * @param App\Models\TrackableLog\TrackableLog  $trackablelog
     * @return \App\Http\Responses\Backend\TrackableLog\ShowResponse
     */
    public function show($id)
    {
        $trackablelog = TrackableLog::findOrFail($id);
        return new ShowResponse($trackablelog);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TrackableLog\TrackableLog  $trackablelog
     * @param  EditTrackableLogRequestNamespace  $request
     * @return \App\Http\Responses\Backend\TrackableLog\EditResponse
     */
    public function edit(TrackableLog $trackablelog, EditTrackableLogRequest $request)
    {
        return new EditResponse($trackablelog);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTrackableLogRequestNamespace  $request
     * @param  App\Models\TrackableLog\TrackableLog  $trackablelog
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateTrackableLogRequest $request, TrackableLog $trackablelog)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $trackablelog, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.trackablelogs.index'), ['flash_success' => trans('alerts.backend.trackablelogs.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteTrackableLogRequestNamespace  $request
     * @param  App\Models\TrackableLog\TrackableLog  $trackablelog
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(TrackableLog $trackablelog, DeleteTrackableLogRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($trackablelog);
        //returning with successfull message
        return new RedirectResponse(route('admin.trackablelogs.index'), ['flash_success' => trans('alerts.backend.trackablelogs.deleted')]);
    }
    
}
