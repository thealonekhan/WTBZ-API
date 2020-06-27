<?php

namespace App\Http\Controllers\Backend\Status;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Status\StatusRepository;
use App\Http\Requests\Backend\Status\ManageStatusRequest;

/**
 * Class StatusesTableController.
 */
class StatusesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var StatusRepository
     */
    protected $status;

    /**
     * contructor to initialize repository object
     * @param StatusRepository $status;
     */
    public function __construct(StatusRepository $status)
    {
        $this->status = $status;
    }

    /**
     * This method return the data of the model
     * @param ManageStatusRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageStatusRequest $request)
    {
        return Datatables::of($this->status->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($status) {
                return Carbon::parse($status->created_at)->toDateString();
            })
            ->addColumn('actions', function ($status) {
                return $status->action_buttons;
            })
            ->make(true);
    }
}
