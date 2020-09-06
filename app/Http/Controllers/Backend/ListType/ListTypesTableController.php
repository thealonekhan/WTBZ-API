<?php

namespace App\Http\Controllers\Backend\ListType;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ListType\ListTypeRepository;
use App\Http\Requests\Backend\ListType\ManageListTypeRequest;

/**
 * Class ListTypesTableController.
 */
class ListTypesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ListTypeRepository
     */
    protected $listtype;

    /**
     * contructor to initialize repository object
     * @param ListTypeRepository $listtype;
     */
    public function __construct(ListTypeRepository $listtype)
    {
        $this->listtype = $listtype;
    }

    /**
     * This method return the data of the model
     * @param ManageListTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageListTypeRequest $request)
    {
        return Datatables::of($this->listtype->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($listtype) {
                return Carbon::parse($listtype->created_at)->toDateString();
            })
            ->addColumn('actions', function ($listtype) {
                return $listtype->action_buttons;
            })
            ->make(true);
    }
}
