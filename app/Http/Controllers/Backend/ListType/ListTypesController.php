<?php

namespace App\Http\Controllers\Backend\ListType;

use App\Models\ListType\ListType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ListType\CreateResponse;
use App\Http\Responses\Backend\ListType\EditResponse;
use App\Repositories\Backend\ListType\ListTypeRepository;
use App\Http\Requests\Backend\ListType\ManageListTypeRequest;
use App\Http\Requests\Backend\ListType\CreateListTypeRequest;
use App\Http\Requests\Backend\ListType\StoreListTypeRequest;
use App\Http\Requests\Backend\ListType\EditListTypeRequest;
use App\Http\Requests\Backend\ListType\UpdateListTypeRequest;
use App\Http\Requests\Backend\ListType\DeleteListTypeRequest;

/**
 * ListTypesController
 */
class ListTypesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ListTypeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ListTypeRepository $repository;
     */
    public function __construct(ListTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ListType\ManageListTypeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageListTypeRequest $request)
    {
        return new ViewResponse('backend.listtypes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateListTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ListType\CreateResponse
     */
    public function create(CreateListTypeRequest $request)
    {
        return new CreateResponse('backend.listtypes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreListTypeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreListTypeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.listtypes.index'), ['flash_success' => trans('alerts.backend.listtypes.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ListType\ListType  $listtype
     * @param  EditListTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ListType\EditResponse
     */
    public function edit(ListType $listtype, EditListTypeRequest $request)
    {
        return new EditResponse($listtype);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateListTypeRequestNamespace  $request
     * @param  App\Models\ListType\ListType  $listtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateListTypeRequest $request, ListType $listtype)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $listtype, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.listtypes.index'), ['flash_success' => trans('alerts.backend.listtypes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteListTypeRequestNamespace  $request
     * @param  App\Models\ListType\ListType  $listtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ListType $listtype, DeleteListTypeRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($listtype);
        //returning with successfull message
        return new RedirectResponse(route('admin.listtypes.index'), ['flash_success' => trans('alerts.backend.listtypes.deleted')]);
    }
    
}
