<?php

namespace App\Http\Controllers\Backend\Country;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Country\CountryRepository;
use App\Http\Requests\Backend\Country\ManageCountryRequest;

/**
 * Class CountriesTableController.
 */
class CountriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var CountryRepository
     */
    protected $country;

    /**
     * contructor to initialize repository object
     * @param CountryRepository $country;
     */
    public function __construct(CountryRepository $country)
    {
        $this->country = $country;
    }

    /**
     * This method return the data of the model
     * @param ManageCountryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCountryRequest $request)
    {
        return Datatables::of($this->country->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('created_at', function ($country) {
                return Carbon::parse($country->created_at)->toDateString();
            })
            ->addColumn('actions', function ($country) {
                return $country->action_buttons;
            })
            ->make(true);
    }
}
