<?php

namespace App\Http\Controllers\Backend\TrackableLog;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\TrackableLog\TrackableLogRepository;
use App\Http\Requests\Backend\TrackableLog\ManageTrackableLogRequest;

/**
 * Class TrackableLogsTableController.
 */
class TrackableLogsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableLogRepository
     */
    protected $trackablelog;

    /**
     * contructor to initialize repository object
     * @param TrackableLogRepository $trackablelog;
     */
    public function __construct(TrackableLogRepository $trackablelog)
    {
        $this->trackablelog = $trackablelog;
    }

    /**
     * This method return the data of the model
     * @param ManageTrackableLogRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTrackableLogRequest $request)
    {
        return Datatables::of($this->trackablelog->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($trackablelog) {
                return Carbon::parse($trackablelog->created_at)->toDateString();
            })
            ->addColumn('actions', function ($trackablelog) {
                return $trackablelog->action_buttons;
            })
            ->make(true);
    }
}
