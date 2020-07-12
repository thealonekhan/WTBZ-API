<?php

namespace App\Http\Controllers\Backend\LogType;

use App\Models\LogType\LogType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\LogType\CreateResponse;
use App\Http\Responses\Backend\LogType\EditResponse;
use App\Repositories\Backend\LogType\LogTypeRepository;
use App\Http\Requests\Backend\LogType\ManageLogTypeRequest;
use App\Http\Requests\Backend\LogType\CreateLogTypeRequest;
use App\Http\Requests\Backend\LogType\StoreLogTypeRequest;
use App\Http\Requests\Backend\LogType\EditLogTypeRequest;
use App\Http\Requests\Backend\LogType\UpdateLogTypeRequest;
use App\Http\Requests\Backend\LogType\DeleteLogTypeRequest;

/**
 * LogTypesController
 */
class LogTypesController extends Controller
{
    /**
     * variable to store the repository object
     * @var LogTypeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param LogTypeRepository $repository;
     */
    public function __construct(LogTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\LogType\ManageLogTypeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageLogTypeRequest $request)
    {
        return new ViewResponse('backend.logtypes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\LogType\CreateResponse
     */
    public function create(CreateLogTypeRequest $request)
    {
        return new CreateResponse('backend.logtypes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreLogTypeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.logtypes.index'), ['flash_success' => trans('alerts.backend.logtypes.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\LogType\LogType  $logtype
     * @param  EditLogTypeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\LogType\EditResponse
     */
    public function edit(LogType $logtype, EditLogTypeRequest $request)
    {
        return new EditResponse($logtype);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLogTypeRequestNamespace  $request
     * @param  App\Models\LogType\LogType  $logtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateLogTypeRequest $request, LogType $logtype)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $logtype, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.logtypes.index'), ['flash_success' => trans('alerts.backend.logtypes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteLogTypeRequestNamespace  $request
     * @param  App\Models\LogType\LogType  $logtype
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(LogType $logtype, DeleteLogTypeRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($logtype);
        //returning with successfull message
        return new RedirectResponse(route('admin.logtypes.index'), ['flash_success' => trans('alerts.backend.logtypes.deleted')]);
    }
    
}
