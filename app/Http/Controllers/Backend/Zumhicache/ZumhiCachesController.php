<?php

namespace App\Http\Controllers\Backend\Zumhicache;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Zumhicache\CreateResponse;
use App\Http\Responses\Backend\Zumhicache\EditResponse;
use App\Http\Responses\Backend\Zumhicache\ShowResponse;
use App\Repositories\Backend\Zumhicache\ZumhiCacheRepository;
use App\Http\Requests\Backend\Zumhicache\ManageZumhiCacheRequest;
use App\Http\Requests\Backend\Zumhicache\CreateZumhiCacheRequest;
use App\Http\Requests\Backend\Zumhicache\StoreZumhiCacheRequest;
use App\Http\Requests\Backend\Zumhicache\EditZumhiCacheRequest;
use App\Http\Requests\Backend\Zumhicache\UpdateZumhiCacheRequest;
use App\Http\Requests\Backend\Zumhicache\DeleteZumhiCacheRequest;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheSizes\ZumhiCacheSize;
use App\Models\ZumhicacheTypes\ZumhiCacheType;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\ZumhicacheMemberships\ZumhiCacheMembership;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;
use App\Models\Status\Status;
use App\Models\Country\Country;
use App\Models\State\State;

/**
 * ZumhiCachesController
 */
class ZumhiCachesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheRepository $repository;
     */
    public function __construct(ZumhiCacheRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Zumhicache\ManageZumhiCacheRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheRequest $request)
    {
        $statuses = Status::pluck('name', 'name');
        return new ViewResponse('backend.zumhicaches.index', ["statuses" => $statuses]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Zumhicache\CreateResponse
     */
    public function create(CreateZumhiCacheRequest $request)
    {
        $statuses = Status::getSelectData();
        $countries = Country::getSelectData();
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');
        $types = ZumhiCacheType::getSelectData();
        $sizes = ZumhiCacheSize::getSelectData();
        $users = ZumhiCacheUser::getSelectData('referenceCode');
        $attributes = ZumhiCacheAttribute::getSelectData();
        
        return new CreateResponse($users, $types, $sizes, $coordinates, $attributes, $countries, $statuses, config('timezone.timezone_ids'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheRequest $request)
    {
        //Create the model using repository create method
        $this->repository->create($request->except('_token'));
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicaches.index'), ['flash_success' => trans('alerts.backend.zumhicaches.created')]);
    }

    /**
     * @param App\Models\Zumhicache\ZumhiCache  $zumhicache
     * @return \App\Http\Responses\Backend\Zumhicache\ShowResponse
     */
    public function show($id)
    {
        $zumhicache = ZumhiCache::findOrFail($id);
        return new ShowResponse($zumhicache);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Zumhicache\ZumhiCache  $zumhicache
     * @param  EditZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Zumhicache\EditResponse
     */
    public function edit($id)
    {
        $zumhicache = ZumhiCache::findOrFail($id);
        $statuses = Status::getSelectData();
        $countries = Country::getSelectData();
        $selectedStates = State::where('country_id', $zumhicache->country_id)->pluck('name', 'id');
        $coordinates = ZumhiCacheCoordinate::get()->pluck('full_name', 'id');
        $types = ZumhiCacheType::getSelectData();
        $sizes = ZumhiCacheSize::getSelectData();
        $users = ZumhiCacheUser::getSelectData('referenceCode');
        $attributes = ZumhiCacheAttribute::getSelectData();
        return new EditResponse($zumhicache, $users, $types, $sizes, $coordinates, $attributes, $countries, $selectedStates, $statuses, config('timezone.timezone_ids'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheRequestNamespace  $request
     * @param  App\Models\Zumhicache\ZumhiCache  $zumhicache
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheRequest $request, $id)
    {
        //Input received from the request
        // $input = $request->except(['_token']);
        //Update the model using zumhicache update method
        $this->repository->update( $id, $request->except('_token') );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicaches.index'), ['flash_success' => trans('alerts.backend.zumhicaches.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheRequestNamespace  $request
     * @param  App\Models\Zumhicache\ZumhiCache  $zumhicache
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(DeleteZumhiCacheRequest $request, $id)
    {
        $zumhicache = ZumhiCache::find($id);
        //Calling the delete method on zumhicache
        $this->repository->delete($zumhicache);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicaches.index'), ['flash_success' => trans('alerts.backend.zumhicaches.deleted')]);
    }

    /**
     * Retrived States from storage.
     *
     * @param  App\Models\Zumhicache\State  $states
     * @return \App\Http\Responses\RedirectResponse
     */
    public function fecth_states(ManageZumhiCacheRequest $request)
    {
        $states = State::where('country_id', $request['countryID'])->pluck('name', 'id');
        return view('backend.zumhicaches.ajax-states')->with([
            'states' => $states,
        ]);
    }
    
}
