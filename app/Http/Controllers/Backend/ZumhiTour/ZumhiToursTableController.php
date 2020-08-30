<?php

namespace App\Http\Controllers\Backend\ZumhiTour;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhiTour\ZumhiTourRepository;
use App\Http\Requests\Backend\ZumhiTour\ManageZumhiTourRequest;

/**
 * Class ZumhiToursTableController.
 */
class ZumhiToursTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiTourRepository
     */
    protected $zumhitour;

    /**
     * contructor to initialize repository object
     * @param ZumhiTourRepository $zumhitour;
     */
    public function __construct(ZumhiTourRepository $zumhitour)
    {
        $this->zumhitour = $zumhitour;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiTourRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiTourRequest $request)
    {
        return Datatables::of($this->zumhitour->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhitour) {
                return Carbon::parse($zumhitour->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhitour) {
                return $zumhitour->action_buttons;
            })
            ->make(true);
    }
}
