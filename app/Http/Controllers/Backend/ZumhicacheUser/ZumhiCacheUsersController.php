<?php

namespace App\Http\Controllers\Backend\ZumhicacheUser;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhiCacheUser\CreateResponse;
use App\Http\Responses\Backend\ZumhiCacheUser\EditResponse;
use App\Http\Responses\Backend\ZumhiCacheUser\ShowResponse;
use App\Repositories\Backend\ZumhicacheUser\ZumhiCacheUserRepository;
use App\Http\Requests\Backend\ZumhicacheUser\ManageZumhiCacheUserRequest;
use App\Http\Requests\Backend\ZumhicacheUser\CreateZumhiCacheUserRequest;
use App\Http\Requests\Backend\ZumhicacheUser\StoreZumhiCacheUserRequest;
use App\Http\Requests\Backend\ZumhicacheUser\EditZumhiCacheUserRequest;
use App\Http\Requests\Backend\ZumhicacheUser\UpdateZumhiCacheUserRequest;
use App\Http\Requests\Backend\ZumhicacheUser\DeleteZumhiCacheUserRequest;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Access\User\User;
use App\Models\ZumhicacheMemberships\ZumhiCacheMembership;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;

/**
 * ZumhiCacheUsersController
 */
class ZumhiCacheUsersController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheUserRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheUserRepository $repository;
     */
    public function __construct(ZumhiCacheUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheUser\ManageZumhiCacheUserRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheUserRequest $request)
    {
        return new ViewResponse('backend.zumhicacheusers.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheUserRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhiCacheUser\CreateResponse
     */
    public function create(CreateZumhiCacheUserRequest $request)
    {
        $users = User::pluck('email', 'id');
        $memberships = ZumhiCacheMembership::getSelectData();
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');
        return new CreateResponse($users, $memberships, $coordinates);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheUserRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheUserRequest $request)
    {
        //Create the model using repository create method
        $this->repository->create($request->except('_token'));
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheusers.index'), ['flash_success' => trans('alerts.backend.zumhicacheusers.created')]);
    }

    /**
     * @param App\Models\ZumhicacheUser\ZumhiCacheUser  $zumhicacheuser
     * @return \App\Http\Responses\Backend\ZumhicacheUser\ShowResponse
     */
    public function show($id)
    {
        $zumhicacheuser = ZumhiCacheUser::findOrFail($id);
        return new ShowResponse($zumhicacheuser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheUser\ZumhiCacheUser  $zumhicacheuser
     * @param  EditZumhiCacheUserRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheUser\EditResponse
     */
    public function edit($id)
    {
        $zumhicacheuser = ZumhiCacheUser::findOrFail($id);
        $users = User::pluck('email', 'id');
        $memberships = ZumhiCacheMembership::getSelectData();
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');

        return new EditResponse($zumhicacheuser, $users, $memberships, $coordinates);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheUserRequestNamespace  $request
     * @param  App\Models\ZumhicacheUser\ZumhiCacheUser  $zumhicacheuser
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheUserRequest $request, $id)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicacheusers.index'), ['flash_success' => trans('alerts.backend.zumhicacheusers.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheUserRequestNamespace  $request
     * @param  App\Models\ZumhicacheUser\ZumhiCacheUser  $zumhicacheuser
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteZumhiCacheUserRequest $request, $id)
    {
        $zumhicacheuser = ZumhiCacheUser::find($id);
        //Calling the delete method on repository
        $this->repository->delete($zumhicacheuser);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicacheusers.index'), ['flash_success' => trans('alerts.backend.zumhicacheusers.deleted')]);
    }
    
}
