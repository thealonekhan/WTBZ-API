<?php

namespace App\Http\Controllers\Backend\ZumhicacheTypes;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheTypes\ZumhiCacheTypeRepository;
use App\Http\Requests\Backend\ZumhicacheTypes\ManageZumhiCacheTypeRequest;

/**
 * Class ZumhiCacheTypesTableController.
 */
class ZumhiCacheTypesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheTypeRepository
     */
    protected $zumhicachetype;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheTypeRepository $zumhicachetype;
     */
    public function __construct(ZumhiCacheTypeRepository $zumhicachetype)
    {
        $this->zumhicachetype = $zumhicachetype;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheTypeRequest $request)
    {
        return Datatables::of($this->zumhicachetype->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicachetype) {
                return Carbon::parse($zumhicachetype->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicachetype) {
                return $zumhicachetype->action_buttons;
            })
            ->make(true);
    }
}
