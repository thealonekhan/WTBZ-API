<?php

namespace App\Http\Controllers\Backend\UserWayPoint;

use App\Models\UserWayPoint\UserWayPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\UserWayPoint\CreateResponse;
use App\Http\Responses\Backend\UserWayPoint\EditResponse;
use App\Http\Responses\Backend\UserWayPoint\ShowResponse;
use App\Repositories\Backend\UserWayPoint\UserWayPointRepository;
use App\Http\Requests\Backend\UserWayPoint\ManageUserWayPointRequest;
use App\Http\Requests\Backend\UserWayPoint\CreateUserWayPointRequest;
use App\Http\Requests\Backend\UserWayPoint\StoreUserWayPointRequest;
use App\Http\Requests\Backend\UserWayPoint\EditUserWayPointRequest;
use App\Http\Requests\Backend\UserWayPoint\UpdateUserWayPointRequest;
use App\Http\Requests\Backend\UserWayPoint\DeleteUserWayPointRequest;

/**
 * UserWayPointsController
 */
class UserWayPointsController extends Controller
{
    /**
     * variable to store the repository object
     * @var UserWayPointRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param UserWayPointRepository $repository;
     */
    public function __construct(UserWayPointRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\UserWayPoint\ManageUserWayPointRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageUserWayPointRequest $request)
    {
        return new ViewResponse('backend.userwaypoints.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateUserWayPointRequestNamespace  $request
     * @return \App\Http\Responses\Backend\UserWayPoint\CreateResponse
     */
    public function create(CreateUserWayPointRequest $request)
    {
        return new CreateResponse('backend.userwaypoints.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserWayPointRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreUserWayPointRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.userwaypoints.index'), ['flash_success' => trans('alerts.backend.userwaypoints.created')]);
    }
    /**
     * @param App\Models\UserWayPoint\UserWayPoint  $userwaypoint
     * @return \App\Http\Responses\Backend\UserWayPoint\ShowResponse
     */
    public function show($id)
    {
        $userwaypoint = UserWayPoint::findOrFail($id);
        return new ShowResponse($userwaypoint);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\UserWayPoint\UserWayPoint  $userwaypoint
     * @param  EditUserWayPointRequestNamespace  $request
     * @return \App\Http\Responses\Backend\UserWayPoint\EditResponse
     */
    public function edit(UserWayPoint $userwaypoint, EditUserWayPointRequest $request)
    {
        return new EditResponse($userwaypoint);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserWayPointRequestNamespace  $request
     * @param  App\Models\UserWayPoint\UserWayPoint  $userwaypoint
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateUserWayPointRequest $request, UserWayPoint $userwaypoint)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $userwaypoint, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.userwaypoints.index'), ['flash_success' => trans('alerts.backend.userwaypoints.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteUserWayPointRequestNamespace  $request
     * @param  App\Models\UserWayPoint\UserWayPoint  $userwaypoint
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(UserWayPoint $userwaypoint, DeleteUserWayPointRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($userwaypoint);
        //returning with successfull message
        return new RedirectResponse(route('admin.userwaypoints.index'), ['flash_success' => trans('alerts.backend.userwaypoints.deleted')]);
    }
    
}
