<?php

namespace App\Http\Controllers\Backend\State;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\State\StateRepository;
use App\Http\Requests\Backend\State\ManageStateRequest;

/**
 * Class StatesTableController.
 */
class StatesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var StateRepository
     */
    protected $state;

    /**
     * contructor to initialize repository object
     * @param StateRepository $state;
     */
    public function __construct(StateRepository $state)
    {
        $this->state = $state;
    }

    /**
     * This method return the data of the model
     * @param ManageStateRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageStateRequest $request)
    {
        return Datatables::of($this->state->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($state) {
                return Carbon::parse($state->created_at)->toDateString();
            })
            ->addColumn('actions', function ($state) {
                return $state->action_buttons;
            })
            ->make(true);
    }
}
