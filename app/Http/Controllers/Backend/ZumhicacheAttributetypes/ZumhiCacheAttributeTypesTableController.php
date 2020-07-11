<?php

namespace App\Http\Controllers\Backend\ZumhicacheAttributetypes;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheAttributetypes\ZumhiCacheAttributeTypeRepository;
use App\Http\Requests\Backend\ZumhicacheAttributetypes\ManageZumhiCacheAttributeTypeRequest;

/**
 * Class ZumhiCacheAttributeTypesTableController.
 */
class ZumhiCacheAttributeTypesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheAttributeTypeRepository
     */
    protected $zumhicacheattributetype;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheAttributeTypeRepository $zumhicacheattributetype;
     */
    public function __construct(ZumhiCacheAttributeTypeRepository $zumhicacheattributetype)
    {
        $this->zumhicacheattributetype = $zumhicacheattributetype;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheAttributeTypeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheAttributeTypeRequest $request)
    {
        return Datatables::of($this->zumhicacheattributetype->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicacheattributetype) {
                return Carbon::parse($zumhicacheattributetype->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicacheattributetype) {
                return $zumhicacheattributetype->action_buttons;
            })
            ->make(true);
    }
}
