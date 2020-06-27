<?php

namespace App\Repositories\Backend\ZumhicacheAttributes;

use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheAttributeRepository.
 */
class ZumhiCacheAttributeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheAttribute::class;

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
                config('module.zumhicacheattributes.table').'.id',
                config('module.zumhicacheattributes.table').'.created_at',
                config('module.zumhicacheattributes.table').'.updated_at',
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
        if (ZumhiCacheAttribute::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheAttribute $zumhicacheattribute
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ZumhiCacheAttribute $zumhicacheattribute, array $input)
    {
    	if ($zumhicacheattribute->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheAttribute $zumhicacheattribute
     * @throws GeneralException
     * @return bool
     */
    public function delete(ZumhiCacheAttribute $zumhicacheattribute)
    {
        if ($zumhicacheattribute->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.delete_error'));
    }
}
