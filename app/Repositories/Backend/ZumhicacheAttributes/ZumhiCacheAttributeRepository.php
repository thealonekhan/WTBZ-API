<?php

namespace App\Repositories\Backend\ZumhicacheAttributes;

use App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeCreated;
use App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeDeleted;
use App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeUpdated;
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
                config('module.zumhicacheattributes.table').'.name',
                config('module.zumhicacheattributes.table').'.isOn',
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
    public function create(array $request)
    {
        $zumhicacheattribute = $this->createZumhicacheAttributeStub($request);
        DB::transaction(function () use ($zumhicacheattribute) {
            if ($zumhicacheattribute->save()) {
                event(new ZumhiCacheAttributeCreated($zumhicacheattribute));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheAttribute $zumhicacheattribute
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicacheattribute = $this->createZumhicacheAttributeStub($request, $id);
    	DB::transaction(function () use ($zumhicacheattribute) {
            if ($zumhicacheattribute->save()) {
                event(new ZumhiCacheAttributeUpdated($zumhicacheattribute));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheAttribute $zumhicacheattribute
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicacheattribute)
    {
        if ($zumhicacheattribute->delete()) {
            event(new ZumhiCacheAttributeDeleted($zumhicacheattribute));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicacheattributes.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheAttributeStub($input, $id=null)
    {
        $zumhicacheattribute = self::MODEL;
        if (!empty($id)) {
            $zumhicacheattribute = $zumhicacheattribute::findOrFail($id);
        } else {
            $zumhicacheattribute = new $zumhicacheattribute();
        }

        
        $zumhicacheattribute->name = $input['name'];
        $zumhicacheattribute->isOn = !empty($input['isOn']) ? $input['isOn'] : 0;
        $zumhicacheattribute->imageUrl = $input['imageUrl'];
        return $zumhicacheattribute;
    }
}
