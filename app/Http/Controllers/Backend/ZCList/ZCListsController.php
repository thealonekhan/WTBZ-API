<?php

namespace App\Http\Controllers\Backend\ZCList;

use App\Models\ZCList\ZCList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZCList\CreateResponse;
use App\Http\Responses\Backend\ZCList\EditResponse;
use App\Http\Responses\Backend\ZCList\ShowResponse;
use App\Repositories\Backend\ZCList\ZCListRepository;
use App\Http\Requests\Backend\ZCList\ManageZCListRequest;
use App\Http\Requests\Backend\ZCList\CreateZCListRequest;
use App\Http\Requests\Backend\ZCList\StoreZCListRequest;
use App\Http\Requests\Backend\ZCList\EditZCListRequest;
use App\Http\Requests\Backend\ZCList\UpdateZCListRequest;
use App\Http\Requests\Backend\ZCList\DeleteZCListRequest;

/**
 * ZCListsController
 */
class ZCListsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZCListRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZCListRepository $repository;
     */
    public function __construct(ZCListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZCList\ManageZCListRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZCListRequest $request)
    {
        return new ViewResponse('backend.zclists.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZCListRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZCList\CreateResponse
     */
    public function create(CreateZCListRequest $request)
    {
        return new CreateResponse('backend.zclists.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZCListRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZCListRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zclists.index'), ['flash_success' => trans('alerts.backend.zclists.created')]);
    }
    /**
     * @param App\Models\ZCList\ZCList  $zclist
     * @return \App\Http\Responses\Backend\ZCList\ShowResponse
     */
    public function show($id)
    {
        $zclist = ZCList::findOrFail($id);
        return new ShowResponse($zclist);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZCList\ZCList  $zclist
     * @param  EditZCListRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZCList\EditResponse
     */
    public function edit(ZCList $zclist, EditZCListRequest $request)
    {
        return new EditResponse($zclist);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZCListRequestNamespace  $request
     * @param  App\Models\ZCList\ZCList  $zclist
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZCListRequest $request, ZCList $zclist)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zclist, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zclists.index'), ['flash_success' => trans('alerts.backend.zclists.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZCListRequestNamespace  $request
     * @param  App\Models\ZCList\ZCList  $zclist
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZCList $zclist, DeleteZCListRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zclist);
        //returning with successfull message
        return new RedirectResponse(route('admin.zclists.index'), ['flash_success' => trans('alerts.backend.zclists.deleted')]);
    }
    
}
