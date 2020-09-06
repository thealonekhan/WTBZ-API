<?php

namespace App\Http\Controllers\Backend\ListZumhiCache;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ListZumhiCache\ListZumhiCacheRepository;
use App\Http\Requests\Backend\ListZumhiCache\ManageListZumhiCacheRequest;

/**
 * Class ListZumhiCachesTableController.
 */
class ListZumhiCachesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ListZumhiCacheRepository
     */
    protected $listzumhicache;

    /**
     * contructor to initialize repository object
     * @param ListZumhiCacheRepository $listzumhicache;
     */
    public function __construct(ListZumhiCacheRepository $listzumhicache)
    {
        $this->listzumhicache = $listzumhicache;
    }

    /**
     * This method return the data of the model
     * @param ManageListZumhiCacheRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageListZumhiCacheRequest $request)
    {
        return Datatables::of($this->listzumhicache->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($listzumhicache) {
                return Carbon::parse($listzumhicache->created_at)->toDateString();
            })
            ->addColumn('actions', function ($listzumhicache) {
                return $listzumhicache->action_buttons;
            })
            ->make(true);
    }
}
