<?php

namespace App\Http\Controllers\Backend\ZumhicacheMemberships;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheMemberships\ZumhiCacheMembershipRepository;
use App\Http\Requests\Backend\ZumhicacheMemberships\ManageZumhiCacheMembershipRequest;

/**
 * Class ZumhiCacheMembershipsTableController.
 */
class ZumhiCacheMembershipsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheMembershipRepository
     */
    protected $zumhicachemembership;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheMembershipRepository $zumhicachemembership;
     */
    public function __construct(ZumhiCacheMembershipRepository $zumhicachemembership)
    {
        $this->zumhicachemembership = $zumhicachemembership;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheMembershipRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheMembershipRequest $request)
    {
        return Datatables::of($this->zumhicachemembership->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicachemembership) {
                return Carbon::parse($zumhicachemembership->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicachemembership) {
                return $zumhicachemembership->action_buttons;
            })
            ->make(true);
    }
}
