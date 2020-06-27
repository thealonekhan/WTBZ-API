<?php

namespace App\Http\Controllers\Backend\ZumhicacheMemberships;

use App\Models\ZumhicacheMemberships\ZumhiCacheMembership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheMemberships\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheMemberships\EditResponse;
use App\Repositories\Backend\ZumhicacheMemberships\ZumhiCacheMembershipRepository;
use App\Http\Requests\Backend\ZumhicacheMemberships\ManageZumhiCacheMembershipRequest;
use App\Http\Requests\Backend\ZumhicacheMemberships\CreateZumhiCacheMembershipRequest;
use App\Http\Requests\Backend\ZumhicacheMemberships\StoreZumhiCacheMembershipRequest;
use App\Http\Requests\Backend\ZumhicacheMemberships\EditZumhiCacheMembershipRequest;
use App\Http\Requests\Backend\ZumhicacheMemberships\UpdateZumhiCacheMembershipRequest;
use App\Http\Requests\Backend\ZumhicacheMemberships\DeleteZumhiCacheMembershipRequest;

/**
 * ZumhiCacheMembershipsController
 */
class ZumhiCacheMembershipsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheMembershipRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheMembershipRepository $repository;
     */
    public function __construct(ZumhiCacheMembershipRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheMemberships\ManageZumhiCacheMembershipRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheMembershipRequest $request)
    {
        return new ViewResponse('backend.zumhicachememberships.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheMembershipRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheMemberships\CreateResponse
     */
    public function create(CreateZumhiCacheMembershipRequest $request)
    {
        return new CreateResponse('backend.zumhicachememberships.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheMembershipRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheMembershipRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachememberships.index'), ['flash_success' => trans('alerts.backend.zumhicachememberships.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheMemberships\ZumhiCacheMembership  $zumhicachemembership
     * @param  EditZumhiCacheMembershipRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheMemberships\EditResponse
     */
    public function edit(ZumhiCacheMembership $zumhicachemembership, EditZumhiCacheMembershipRequest $request)
    {
        return new EditResponse($zumhicachemembership);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheMembershipRequestNamespace  $request
     * @param  App\Models\ZumhicacheMemberships\ZumhiCacheMembership  $zumhicachemembership
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheMembershipRequest $request, ZumhiCacheMembership $zumhicachemembership)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zumhicachemembership, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachememberships.index'), ['flash_success' => trans('alerts.backend.zumhicachememberships.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheMembershipRequestNamespace  $request
     * @param  App\Models\ZumhicacheMemberships\ZumhiCacheMembership  $zumhicachemembership
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZumhiCacheMembership $zumhicachemembership, DeleteZumhiCacheMembershipRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zumhicachemembership);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicachememberships.index'), ['flash_success' => trans('alerts.backend.zumhicachememberships.deleted')]);
    }
    
}
