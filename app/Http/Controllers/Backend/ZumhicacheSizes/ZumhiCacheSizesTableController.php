<?php

namespace App\Http\Controllers\Backend\ZumhicacheSizes;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheSizes\ZumhiCacheSizeRepository;
use App\Http\Requests\Backend\ZumhicacheSizes\ManageZumhiCacheSizeRequest;

/**
 * Class ZumhiCacheSizesTableController.
 */
class ZumhiCacheSizesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheSizeRepository
     */
    protected $zumhicachesize;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheSizeRepository $zumhicachesize;
     */
    public function __construct(ZumhiCacheSizeRepository $zumhicachesize)
    {
        $this->zumhicachesize = $zumhicachesize;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheSizeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheSizeRequest $request)
    {
        return Datatables::of($this->zumhicachesize->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicachesize) {
                return Carbon::parse($zumhicachesize->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicachesize) {
                return $zumhicachesize->action_buttons;
            })
            ->make(true);
    }
}
