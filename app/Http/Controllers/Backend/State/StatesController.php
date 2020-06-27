<?php

namespace App\Http\Controllers\Backend\State;

use App\Models\State\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\State\CreateResponse;
use App\Http\Responses\Backend\State\EditResponse;
use App\Repositories\Backend\State\StateRepository;
use App\Http\Requests\Backend\State\ManageStateRequest;
use App\Http\Requests\Backend\State\CreateStateRequest;
use App\Http\Requests\Backend\State\StoreStateRequest;
use App\Http\Requests\Backend\State\EditStateRequest;
use App\Http\Requests\Backend\State\UpdateStateRequest;
use App\Http\Requests\Backend\State\DeleteStateRequest;

/**
 * StatesController
 */
class StatesController extends Controller
{
    /**
     * variable to store the repository object
     * @var StateRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param StateRepository $repository;
     */
    public function __construct(StateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\State\ManageStateRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageStateRequest $request)
    {
        return new ViewResponse('backend.states.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateStateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\State\CreateResponse
     */
    public function create(CreateStateRequest $request)
    {
        return new CreateResponse('backend.states.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStateRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreStateRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.states.index'), ['flash_success' => trans('alerts.backend.states.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\State\State  $state
     * @param  EditStateRequestNamespace  $request
     * @return \App\Http\Responses\Backend\State\EditResponse
     */
    public function edit(State $state, EditStateRequest $request)
    {
        return new EditResponse($state);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStateRequestNamespace  $request
     * @param  App\Models\State\State  $state
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $state, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.states.index'), ['flash_success' => trans('alerts.backend.states.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteStateRequestNamespace  $request
     * @param  App\Models\State\State  $state
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(State $state, DeleteStateRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($state);
        //returning with successfull message
        return new RedirectResponse(route('admin.states.index'), ['flash_success' => trans('alerts.backend.states.deleted')]);
    }
    
}
