<?php

namespace App\Repositories\Backend\ZumhicacheTypes;

use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheTypes\ZumhiCacheType;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheTypeRepository.
 */
class ZumhiCacheTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheType::class;

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
                config('module.zumhicachetypes.table').'.id',
                config('module.zumhicachetypes.table').'.created_at',
                config('module.zumhicachetypes.table').'.updated_at',
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
        if (ZumhiCacheType::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.zumhicachetypes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheType $zumhicachetype
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ZumhiCacheType $zumhicachetype, array $input)
    {
    	if ($zumhicachetype->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.zumhicachetypes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheType $zumhicachetype
     * @throws GeneralException
     * @return bool
     */
    public function delete(ZumhiCacheType $zumhicachetype)
    {
        if ($zumhicachetype->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachetypes.delete_error'));
    }
}
