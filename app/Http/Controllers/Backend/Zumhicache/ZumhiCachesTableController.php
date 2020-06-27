<?php

namespace App\Http\Controllers\Backend\Zumhicache;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Zumhicache\ZumhiCacheRepository;
use App\Http\Requests\Backend\Zumhicache\ManageZumhiCacheRequest;

/**
 * Class ZumhiCachesTableController.
 */
class ZumhiCachesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheRepository
     */
    protected $zumhicache;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheRepository $zumhicache;
     */
    public function __construct(ZumhiCacheRepository $zumhicache)
    {
        $this->zumhicache = $zumhicache;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheRequest $request)
    {
        return Datatables::of($this->zumhicache->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicache) {
                return Carbon::parse($zumhicache->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicache) {
                return $zumhicache->action_buttons;
            })
            ->make(true);
    }
}
