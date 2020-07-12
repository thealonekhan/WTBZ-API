<?php

namespace App\Http\Controllers\Backend\ZumhicacheLog;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheLog\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheLog\EditResponse;
use App\Http\Responses\Backend\ZumhicacheLog\ShowResponse;
use App\Repositories\Backend\ZumhicacheLog\ZumhiCacheLogRepository;
use App\Http\Requests\Backend\ZumhicacheLog\ManageZumhiCacheLogRequest;
use App\Http\Requests\Backend\ZumhicacheLog\CreateZumhiCacheLogRequest;
use App\Http\Requests\Backend\ZumhicacheLog\StoreZumhiCacheLogRequest;
use App\Http\Requests\Backend\ZumhicacheLog\EditZumhiCacheLogRequest;
use App\Http\Requests\Backend\ZumhicacheLog\UpdateZumhiCacheLogRequest;
use App\Http\Requests\Backend\ZumhicacheLog\DeleteZumhiCacheLogRequest;
use App\Models\ZumhicacheLog\ZumhiCacheLog;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\LogType\LogType;

/**
 * ZumhiCacheLogsController
 */
class ZumhiCacheLogsController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheLogRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheLogRepository $repository;
     */
    public function __construct(ZumhiCacheLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheLog\ManageZumhiCacheLogRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheLogRequest $request)
    {
        return new ViewResponse('backend.zumhicachelogs.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheLogRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheLog\CreateResponse
     */
    public function create(CreateZumhiCacheLogRequest $request)
    {
        return new CreateResponse('backend.zumhicachelogs.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheLogRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheLogRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachelogs.index'), ['flash_success' => trans('alerts.backend.zumhicachelogs.created')]);
    }

    /**
     * @param App\Models\ZumhicacheLog\ZumhiCacheLog  $zumhicachelog
     * @return \App\Http\Responses\Backend\ZumhicacheLog\ShowResponse
     */
    public function show($id)
    {
        $zumhicachelog = ZumhiCacheLog::findOrFail($id);
        return new ShowResponse($zumhicachelog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheLog\ZumhiCacheLog  $zumhicachelog
     * @param  EditZumhiCacheLogRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheLog\EditResponse
     */
    public function edit(ZumhiCacheLog $zumhicachelog, EditZumhiCacheLogRequest $request)
    {
        return new EditResponse($zumhicachelog);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheLogRequestNamespace  $request
     * @param  App\Models\ZumhicacheLog\ZumhiCacheLog  $zumhicachelog
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheLogRequest $request, ZumhiCacheLog $zumhicachelog)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zumhicachelog, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachelogs.index'), ['flash_success' => trans('alerts.backend.zumhicachelogs.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheLogRequestNamespace  $request
     * @param  App\Models\ZumhicacheLog\ZumhiCacheLog  $zumhicachelog
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZumhiCacheLog $zumhicachelog, DeleteZumhiCacheLogRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zumhicachelog);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicachelogs.index'), ['flash_success' => trans('alerts.backend.zumhicachelogs.deleted')]);
    }
    
}
