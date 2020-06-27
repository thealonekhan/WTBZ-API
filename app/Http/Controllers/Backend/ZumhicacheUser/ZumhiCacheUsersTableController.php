<?php

namespace App\Http\Controllers\Backend\ZumhicacheUser;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheUser\ZumhiCacheUserRepository;
use App\Http\Requests\Backend\ZumhicacheUser\ManageZumhiCacheUserRequest;

/**
 * Class ZumhiCacheUsersTableController.
 */
class ZumhiCacheUsersTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheUserRepository
     */
    protected $zumhicacheuser;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheUserRepository $zumhicacheuser;
     */
    public function __construct(ZumhiCacheUserRepository $zumhicacheuser)
    {
        $this->zumhicacheuser = $zumhicacheuser;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheUserRequest $request)
    {
        return Datatables::of($this->zumhicacheuser->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicacheuser) {
                return Carbon::parse($zumhicacheuser->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicacheuser) {
                return $zumhicacheuser->action_buttons;
            })
            ->make(true);
    }
}
