<?php

namespace App\Http\Controllers\Backend\LogType;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\LogType\LogTypeRepository;
use App\Http\Requests\Backend\LogType\ManageLogTypeRequest;

/**
 * Class LogTypesTableController.
 */
class LogTypesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var LogTypeRepository
     */
    protected $logtype;

    /**
     * contructor to initialize repository object
     * @param LogTypeRepository $logtype;
     */
    public function __construct(LogTypeRepository $logtype)
    {
        $this->logtype = $logtype;
    }

    /**
     * This method return the data of the model
     * @param ManageLogTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageLogTypeRequest $request)
    {
        return Datatables::of($this->logtype->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($logtype) {
                return Carbon::parse($logtype->created_at)->toDateString();
            })
            ->addColumn('actions', function ($logtype) {
                return $logtype->action_buttons;
            })
            ->make(true);
    }
}
