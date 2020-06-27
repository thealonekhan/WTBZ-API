<?php

namespace App\Http\Controllers\Backend\Status;

use App\Models\Status\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Status\CreateResponse;
use App\Http\Responses\Backend\Status\EditResponse;
use App\Repositories\Backend\Status\StatusRepository;
use App\Http\Requests\Backend\Status\ManageStatusRequest;
use App\Http\Requests\Backend\Status\CreateStatusRequest;
use App\Http\Requests\Backend\Status\StoreStatusRequest;
use App\Http\Requests\Backend\Status\EditStatusRequest;
use App\Http\Requests\Backend\Status\UpdateStatusRequest;
use App\Http\Requests\Backend\Status\DeleteStatusRequest;

/**
 * StatusesController
 */
class StatusesController extends Controller
{
    /**
     * variable to store the repository object
     * @var StatusRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param StatusRepository $repository;
     */
    public function __construct(StatusRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Status\ManageStatusRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageStatusRequest $request)
    {
        return new ViewResponse('backend.statuses.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateStatusRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Status\CreateResponse
     */
    public function create(CreateStatusRequest $request)
    {
        return new CreateResponse('backend.statuses.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStatusRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreStatusRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.statuses.index'), ['flash_success' => trans('alerts.backend.statuses.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Status\Status  $status
     * @param  EditStatusRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Status\EditResponse
     */
    public function edit(Status $status, EditStatusRequest $request)
    {
        return new EditResponse($status);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStatusRequestNamespace  $request
     * @param  App\Models\Status\Status  $status
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $status, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.statuses.index'), ['flash_success' => trans('alerts.backend.statuses.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteStatusRequestNamespace  $request
     * @param  App\Models\Status\Status  $status
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Status $status, DeleteStatusRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($status);
        //returning with successfull message
        return new RedirectResponse(route('admin.statuses.index'), ['flash_success' => trans('alerts.backend.statuses.deleted')]);
    }
    
}
