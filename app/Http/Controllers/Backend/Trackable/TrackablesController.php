<?php

namespace App\Http\Controllers\Backend\Trackable;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Trackable\CreateResponse;
use App\Http\Responses\Backend\Trackable\EditResponse;
use App\Http\Responses\Backend\Trackable\ShowResponse;
use App\Repositories\Backend\Trackable\TrackableRepository;
use App\Http\Requests\Backend\Trackable\ManageTrackableRequest;
use App\Http\Requests\Backend\Trackable\CreateTrackableRequest;
use App\Http\Requests\Backend\Trackable\StoreTrackableRequest;
use App\Http\Requests\Backend\Trackable\EditTrackableRequest;
use App\Http\Requests\Backend\Trackable\UpdateTrackableRequest;
use App\Http\Requests\Backend\Trackable\DeleteTrackableRequest;
use App\Models\Trackable\Trackable;
use App\Models\Country\Country;
use App\Models\LogType\LogType;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Zumhicache\ZumhiCache;

/**
 * TrackablesController
 */
class TrackablesController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param TrackableRepository $repository;
     */
    public function __construct(TrackableRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Trackable\ManageTrackableRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageTrackableRequest $request)
    {
        return new ViewResponse('backend.trackables.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateTrackableRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Trackable\CreateResponse
     */
    public function create(CreateTrackableRequest $request)
    {
        $countries = Country::getSelectData();
        $types = LogType::getSelectData();
        $ownerCodes = ZumhiCacheUser::get()->pluck('referenceCode', 'referenceCode');
        $zumhiCodes = ZumhiCache::get()->pluck('referenceCode', 'referenceCode');
        return new CreateResponse($countries, $types, $ownerCodes, $zumhiCodes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTrackableRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreTrackableRequest $request)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($request->except('_token'));
        //return with successfull message
        return new RedirectResponse(route('admin.trackables.index'), ['flash_success' => trans('alerts.backend.trackables.created')]);
    }
    /**
     * @param App\Models\Trackable\Trackable  $trackable
     * @return \App\Http\Responses\Backend\Trackable\ShowResponse
     */
    public function show($id)
    {
        $trackable = Trackable::findOrFail($id);
        return new ShowResponse($trackable);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Trackable\Trackable  $trackable
     * @param  EditTrackableRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Trackable\EditResponse
     */
    public function edit($id)
    {
        $trackable = Trackable::findOrFail($id);
        $countries = Country::getSelectData();
        $types = LogType::getSelectData();
        $ownerCodes = ZumhiCacheUser::get()->pluck('referenceCode', 'referenceCode');
        $zumhiCodes = ZumhiCache::get()->pluck('referenceCode', 'referenceCode');
        return new EditResponse($trackable, $countries, $types, $ownerCodes, $zumhiCodes);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTrackableRequestNamespace  $request
     * @param  App\Models\Trackable\Trackable  $trackable
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateTrackableRequest $request, $id)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.trackables.index'), ['flash_success' => trans('alerts.backend.trackables.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteTrackableRequestNamespace  $request
     * @param  App\Models\Trackable\Trackable  $trackable
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteTrackableRequest $request, $id)
    {
        $trackable = Trackable::find($id);
        //Calling the delete method on repository
        $this->repository->delete($trackable);
        //returning with successfull message
        return new RedirectResponse(route('admin.trackables.index'), ['flash_success' => trans('alerts.backend.trackables.deleted')]);
    }
    
}
