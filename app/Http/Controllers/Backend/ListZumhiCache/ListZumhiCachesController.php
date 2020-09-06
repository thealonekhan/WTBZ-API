<?php

namespace App\Http\Controllers\Backend\ListZumhiCache;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ListZumhiCache\CreateResponse;
use App\Http\Responses\Backend\ListZumhiCache\EditResponse;
use App\Http\Responses\Backend\ListZumhiCache\ShowResponse;
use App\Repositories\Backend\ListZumhiCache\ListZumhiCacheRepository;
use App\Http\Requests\Backend\ListZumhiCache\ManageListZumhiCacheRequest;
use App\Http\Requests\Backend\ListZumhiCache\CreateListZumhiCacheRequest;
use App\Http\Requests\Backend\ListZumhiCache\StoreListZumhiCacheRequest;
use App\Http\Requests\Backend\ListZumhiCache\EditListZumhiCacheRequest;
use App\Http\Requests\Backend\ListZumhiCache\UpdateListZumhiCacheRequest;
use App\Http\Requests\Backend\ListZumhiCache\DeleteListZumhiCacheRequest;
use App\Models\ListZumhiCache\ListZumhiCache;

/**
 * ListZumhiCachesController
 */
class ListZumhiCachesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ListZumhiCacheRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ListZumhiCacheRepository $repository;
     */
    public function __construct(ListZumhiCacheRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ListZumhiCache\ManageListZumhiCacheRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageListZumhiCacheRequest $request)
    {
        return new ViewResponse('backend.listzumhicaches.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateListZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ListZumhiCache\CreateResponse
     */
    public function create(CreateListZumhiCacheRequest $request)
    {
        return new CreateResponse('backend.listzumhicaches.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreListZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreListZumhiCacheRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.listzumhicaches.index'), ['flash_success' => trans('alerts.backend.listzumhicaches.created')]);
    }
    /**
     * @param App\Models\ListZumhiCache\ListZumhiCache  $listzumhicache
     * @return \App\Http\Responses\Backend\ListZumhiCache\ShowResponse
     */
    public function show($id)
    {
        $listzumhicache = ListZumhiCache::findOrFail($id);
        return new ShowResponse($listzumhicache);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ListZumhiCache\ListZumhiCache  $listzumhicache
     * @param  EditListZumhiCacheRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ListZumhiCache\EditResponse
     */
    public function edit(ListZumhiCache $listzumhicache, EditListZumhiCacheRequest $request)
    {
        return new EditResponse($listzumhicache);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateListZumhiCacheRequestNamespace  $request
     * @param  App\Models\ListZumhiCache\ListZumhiCache  $listzumhicache
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateListZumhiCacheRequest $request, ListZumhiCache $listzumhicache)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $listzumhicache, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.listzumhicaches.index'), ['flash_success' => trans('alerts.backend.listzumhicaches.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteListZumhiCacheRequestNamespace  $request
     * @param  App\Models\ListZumhiCache\ListZumhiCache  $listzumhicache
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ListZumhiCache $listzumhicache, DeleteListZumhiCacheRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($listzumhicache);
        //returning with successfull message
        return new RedirectResponse(route('admin.listzumhicaches.index'), ['flash_success' => trans('alerts.backend.listzumhicaches.deleted')]);
    }
    
}
