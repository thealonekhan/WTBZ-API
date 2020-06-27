<?php

namespace App\Http\Controllers\Backend\ZumhicacheCoordinates;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheCoordinates\ZumhiCacheCoordinateRepository;
use App\Http\Requests\Backend\ZumhicacheCoordinates\ManageZumhiCacheCoordinateRequest;

/**
 * Class ZumhiCacheCoordinatesTableController.
 */
class ZumhiCacheCoordinatesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheCoordinateRepository
     */
    protected $zumhicachecoordinate;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheCoordinateRepository $zumhicachecoordinate;
     */
    public function __construct(ZumhiCacheCoordinateRepository $zumhicachecoordinate)
    {
        $this->zumhicachecoordinate = $zumhicachecoordinate;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheCoordinateRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheCoordinateRequest $request)
    {
        return Datatables::of($this->zumhicachecoordinate->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicachecoordinate) {
                return Carbon::parse($zumhicachecoordinate->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicachecoordinate) {
                return $zumhicachecoordinate->action_buttons;
            })
            ->make(true);
    }
}
