<?php

namespace App\Repositories\Backend\ZumhicacheMemberships;

use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheMemberships\ZumhiCacheMembership;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheMembershipRepository.
 */
class ZumhiCacheMembershipRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheMembership::class;

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
                config('module.zumhicachememberships.table').'.id',
                config('module.zumhicachememberships.table').'.name',
                config('module.zumhicachememberships.table').'.created_at',
                config('module.zumhicachememberships.table').'.updated_at',
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
        if (ZumhiCacheMembership::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.zumhicachememberships.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheMembership $zumhicachemembership
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ZumhiCacheMembership $zumhicachemembership, array $input)
    {
    	if ($zumhicachemembership->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.zumhicachememberships.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheMembership $zumhicachemembership
     * @throws GeneralException
     * @return bool
     */
    public function delete(ZumhiCacheMembership $zumhicachemembership)
    {
        if ($zumhicachemembership->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachememberships.delete_error'));
    }
}
