<?php

namespace App\Repositories\Backend\ZumhicacheSizes;

use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheSizes\ZumhiCacheSize;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheSizeRepository.
 */
class ZumhiCacheSizeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheSize::class;

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
                config('module.zumhicachesizes.table').'.id',
                config('module.zumhicachesizes.table').'.created_at',
                config('module.zumhicachesizes.table').'.updated_at',
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
        if (ZumhiCacheSize::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.zumhicachesizes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheSize $zumhicachesize
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ZumhiCacheSize $zumhicachesize, array $input)
    {
    	if ($zumhicachesize->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.zumhicachesizes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheSize $zumhicachesize
     * @throws GeneralException
     * @return bool
     */
    public function delete(ZumhiCacheSize $zumhicachesize)
    {
        if ($zumhicachesize->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachesizes.delete_error'));
    }
}
