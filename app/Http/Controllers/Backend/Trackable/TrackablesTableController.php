<?php

namespace App\Http\Controllers\Backend\Trackable;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Trackable\TrackableRepository;
use App\Http\Requests\Backend\Trackable\ManageTrackableRequest;

/**
 * Class TrackablesTableController.
 */
class TrackablesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableRepository
     */
    protected $trackable;

    /**
     * contructor to initialize repository object
     * @param TrackableRepository $trackable;
     */
    public function __construct(TrackableRepository $trackable)
    {
        $this->trackable = $trackable;
    }

    /**
     * This method return the data of the model
     * @param ManageTrackableRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTrackableRequest $request)
    {
        return Datatables::of($this->trackable->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($trackable) {
                return Carbon::parse($trackable->created_at)->toDateString();
            })
            ->addColumn('actions', function ($trackable) {
                return $trackable->action_buttons;
            })
            ->make(true);
    }
}
