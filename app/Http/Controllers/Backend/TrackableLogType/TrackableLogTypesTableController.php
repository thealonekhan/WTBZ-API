<?php

namespace App\Http\Controllers\Backend\TrackableLogType;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\TrackableLogType\TrackableLogTypeRepository;
use App\Http\Requests\Backend\TrackableLogType\ManageTrackableLogTypeRequest;

/**
 * Class TrackableLogTypesTableController.
 */
class TrackableLogTypesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var TrackableLogTypeRepository
     */
    protected $trackablelogtype;

    /**
     * contructor to initialize repository object
     * @param TrackableLogTypeRepository $trackablelogtype;
     */
    public function __construct(TrackableLogTypeRepository $trackablelogtype)
    {
        $this->trackablelogtype = $trackablelogtype;
    }

    /**
     * This method return the data of the model
     * @param ManageTrackableLogTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTrackableLogTypeRequest $request)
    {
        return Datatables::of($this->trackablelogtype->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($trackablelogtype) {
                return Carbon::parse($trackablelogtype->created_at)->toDateString();
            })
            ->addColumn('actions', function ($trackablelogtype) {
                return $trackablelogtype->action_buttons;
            })
            ->make(true);
    }
}
