<?php

namespace App\Repositories\Backend\Country;

use DB;
use Carbon\Carbon;
use App\Models\Country\Country;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryRepository.
 */
class CountryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Country::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.countries.table').'.id',
                config('module.countries.table').'.code',
                config('module.countries.table').'.name',
                config('module.countries.table').'.created_at',
                config('module.countries.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        if (Country::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.countries.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Country $country
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Country $country, array $input)
    {
    	if ($country->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.countries.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Country $country
     * @throws GeneralException
     * @return bool
     */
    public function delete(Country $country)
    {
        if ($country->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.countries.delete_error'));
    }
}
