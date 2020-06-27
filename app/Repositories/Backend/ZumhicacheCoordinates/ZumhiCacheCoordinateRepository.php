<?php

namespace App\Repositories\Backend\ZumhicacheCoordinates;

use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheCoordinateRepository.
 */
class ZumhiCacheCoordinateRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheCoordinate::class;

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
                config('module.zumhicachecoordinates.table').'.id',
                config('module.zumhicachecoordinates.table').'.created_at',
                config('module.zumhicachecoordinates.table').'.updated_at',
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
        if (ZumhiCacheCoordinate::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheCoordinate $zumhicachecoordinate
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ZumhiCacheCoordinate $zumhicachecoordinate, array $input)
    {
    	if ($zumhicachecoordinate->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheCoordinate $zumhicachecoordinate
     * @throws GeneralException
     * @return bool
     */
    public function delete(ZumhiCacheCoordinate $zumhicachecoordinate)
    {
        if ($zumhicachecoordinate->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.delete_error'));
    }
}
