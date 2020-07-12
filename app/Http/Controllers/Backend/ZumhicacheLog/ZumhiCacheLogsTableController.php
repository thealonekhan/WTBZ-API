<?php

namespace App\Http\Controllers\Backend\ZumhicacheLog;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheLog\ZumhiCacheLogRepository;
use App\Http\Requests\Backend\ZumhicacheLog\ManageZumhiCacheLogRequest;

/**
 * Class ZumhiCacheLogsTableController.
 */
class ZumhiCacheLogsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheLogRepository
     */
    protected $zumhicachelog;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheLogRepository $zumhicachelog;
     */
    public function __construct(ZumhiCacheLogRepository $zumhicachelog)
    {
        $this->zumhicachelog = $zumhicachelog;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheLogRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheLogRequest $request)
    {
        return Datatables::of($this->zumhicachelog->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicachelog) {
                return Carbon::parse($zumhicachelog->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicachelog) {
                return $zumhicachelog->action_buttons;
            })
            ->make(true);
    }
}
