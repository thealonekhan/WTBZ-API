<?php

namespace App\Http\Controllers\Backend\ZumhicacheSizes;

use App\Models\ZumhicacheSizes\ZumhiCacheSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\ZumhicacheSizes\CreateResponse;
use App\Http\Responses\Backend\ZumhicacheSizes\EditResponse;
use App\Repositories\Backend\ZumhicacheSizes\ZumhiCacheSizeRepository;
use App\Http\Requests\Backend\ZumhicacheSizes\ManageZumhiCacheSizeRequest;
use App\Http\Requests\Backend\ZumhicacheSizes\CreateZumhiCacheSizeRequest;
use App\Http\Requests\Backend\ZumhicacheSizes\StoreZumhiCacheSizeRequest;
use App\Http\Requests\Backend\ZumhicacheSizes\EditZumhiCacheSizeRequest;
use App\Http\Requests\Backend\ZumhicacheSizes\UpdateZumhiCacheSizeRequest;
use App\Http\Requests\Backend\ZumhicacheSizes\DeleteZumhiCacheSizeRequest;

/**
 * ZumhiCacheSizesController
 */
class ZumhiCacheSizesController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheSizeRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheSizeRepository $repository;
     */
    public function __construct(ZumhiCacheSizeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\ZumhicacheSizes\ManageZumhiCacheSizeRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageZumhiCacheSizeRequest $request)
    {
        return new ViewResponse('backend.zumhicachesizes.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateZumhiCacheSizeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheSizes\CreateResponse
     */
    public function create(CreateZumhiCacheSizeRequest $request)
    {
        return new CreateResponse('backend.zumhicachesizes.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreZumhiCacheSizeRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreZumhiCacheSizeRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachesizes.index'), ['flash_success' => trans('alerts.backend.zumhicachesizes.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\ZumhicacheSizes\ZumhiCacheSize  $zumhicachesize
     * @param  EditZumhiCacheSizeRequestNamespace  $request
     * @return \App\Http\Responses\Backend\ZumhicacheSizes\EditResponse
     */
    public function edit(ZumhiCacheSize $zumhicachesize, EditZumhiCacheSizeRequest $request)
    {
        return new EditResponse($zumhicachesize);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateZumhiCacheSizeRequestNamespace  $request
     * @param  App\Models\ZumhicacheSizes\ZumhiCacheSize  $zumhicachesize
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateZumhiCacheSizeRequest $request, ZumhiCacheSize $zumhicachesize)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $zumhicachesize, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.zumhicachesizes.index'), ['flash_success' => trans('alerts.backend.zumhicachesizes.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteZumhiCacheSizeRequestNamespace  $request
     * @param  App\Models\ZumhicacheSizes\ZumhiCacheSize  $zumhicachesize
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ZumhiCacheSize $zumhicachesize, DeleteZumhiCacheSizeRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($zumhicachesize);
        //returning with successfull message
        return new RedirectResponse(route('admin.zumhicachesizes.index'), ['flash_success' => trans('alerts.backend.zumhicachesizes.deleted')]);
    }
    
}
