<?php

namespace App\Http\Controllers\Backend\ZCList;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZCList\ZCListRepository;
use App\Http\Requests\Backend\ZCList\ManageZCListRequest;

/**
 * Class ZCListsTableController.
 */
class ZCListsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZCListRepository
     */
    protected $zclist;

    /**
     * contructor to initialize repository object
     * @param ZCListRepository $zclist;
     */
    public function __construct(ZCListRepository $zclist)
    {
        $this->zclist = $zclist;
    }

    /**
     * This method return the data of the model
     * @param ManageZCListRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZCListRequest $request)
    {
        return Datatables::of($this->zclist->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zclist) {
                return Carbon::parse($zclist->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zclist) {
                return $zclist->action_buttons;
            })
            ->make(true);
    }
}
