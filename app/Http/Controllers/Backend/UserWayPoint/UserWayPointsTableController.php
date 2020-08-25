<?php

namespace App\Http\Controllers\Backend\UserWayPoint;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\UserWayPoint\UserWayPointRepository;
use App\Http\Requests\Backend\UserWayPoint\ManageUserWayPointRequest;

/**
 * Class UserWayPointsTableController.
 */
class UserWayPointsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var UserWayPointRepository
     */
    protected $userwaypoint;

    /**
     * contructor to initialize repository object
     * @param UserWayPointRepository $userwaypoint;
     */
    public function __construct(UserWayPointRepository $userwaypoint)
    {
        $this->userwaypoint = $userwaypoint;
    }

    /**
     * This method return the data of the model
     * @param ManageUserWayPointRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserWayPointRequest $request)
    {
        return Datatables::of($this->userwaypoint->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($userwaypoint) {
                return Carbon::parse($userwaypoint->created_at)->toDateString();
            })
            ->addColumn('actions', function ($userwaypoint) {
                return $userwaypoint->action_buttons;
            })
            ->make(true);
    }
}
