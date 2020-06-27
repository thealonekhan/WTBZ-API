<?php

namespace App\Http\Controllers\Backend\ZumhicacheAttributes;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\ZumhicacheAttributes\ZumhiCacheAttributeRepository;
use App\Http\Requests\Backend\ZumhicacheAttributes\ManageZumhiCacheAttributeRequest;

/**
 * Class ZumhiCacheAttributesTableController.
 */
class ZumhiCacheAttributesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ZumhiCacheAttributeRepository
     */
    protected $zumhicacheattribute;

    /**
     * contructor to initialize repository object
     * @param ZumhiCacheAttributeRepository $zumhicacheattribute;
     */
    public function __construct(ZumhiCacheAttributeRepository $zumhicacheattribute)
    {
        $this->zumhicacheattribute = $zumhicacheattribute;
    }

    /**
     * This method return the data of the model
     * @param ManageZumhiCacheAttributeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageZumhiCacheAttributeRequest $request)
    {
        return Datatables::of($this->zumhicacheattribute->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($zumhicacheattribute) {
                return Carbon::parse($zumhicacheattribute->created_at)->toDateString();
            })
            ->addColumn('actions', function ($zumhicacheattribute) {
                return $zumhicacheattribute->action_buttons;
            })
            ->make(true);
    }
}
