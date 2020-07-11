<?php

namespace App\Repositories\Backend\ZumhicacheAttributetypes;

use App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeCreated;
use App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeDeleted;
use App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheAttributeTypeRepository.
 */
class ZumhiCacheAttributeTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheAttributeType::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin(config('module.zumhicacheattributes.table'), config('module.zumhicacheattributetypes.table').'.attribute_id', '=', config('module.zumhicacheattributes.table').'.id')
            ->select([
                config('module.zumhicacheattributetypes.table').'.id',
                config('module.zumhicacheattributetypes.table').'.name',
                config('module.zumhicacheattributes.table').'.name as attribute',
                config('module.zumhicacheattributetypes.table').'.created_at',
                config('module.zumhicacheattributetypes.table').'.updated_at',
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
        $zumhicacheattributetype = $this->createZumhicacheAttributeTypeStub($request);
        DB::transaction(function () use ($zumhicacheattributetype) {
            if ($zumhicacheattributetype->save()) {
                event(new ZumhiCacheAttributeTypeCreated($zumhicacheattributetype));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheattributetypes.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheAttributeType $zumhicacheattributetype
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
    	$zumhicacheattributetype = $this->createZumhicacheAttributeTypeStub($request, $id);
    	DB::transaction(function () use ($zumhicacheattributetype) {
            if ($zumhicacheattributetype->save()) {
                event(new ZumhiCacheAttributeTypeUpdated($zumhicacheattributetype));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheattributetypes.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheAttributeType $zumhicacheattributetype
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicacheattributetype)
    {
        if ($zumhicacheattributetype->delete()) {
            event(new ZumhiCacheAttributeTypeDeleted($zumhicacheattributetype));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicacheattributetypes.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheAttributeTypeStub($input, $id=null)
    {
        $zumhicacheattributetype = self::MODEL;
        if (!empty($id)) {
            $zumhicacheattributetype = $zumhicacheattributetype::findOrFail($id);
        } else {
            $zumhicacheattributetype = new $zumhicacheattributetype();
        }

        
        $zumhicacheattributetype->attribute_id = $input['attribute_id'];
        $zumhicacheattributetype->name = $input['name'];
        $zumhicacheattributetype->hasYesOption = !empty($input['hasYesOption']) ? $input['hasYesOption'] : 0;
        $zumhicacheattributetype->hasNoOption = !empty($input['hasNoOption']) ? $input['hasNoOption'] : 0;
        $zumhicacheattributetype->yesIconUrl = $input['yesIconUrl'];
        $zumhicacheattributetype->noIconUrl = $input['noIconUrl'];
        $zumhicacheattributetype->notChosenIconUrl = $input['notChosenIconUrl'];
        return $zumhicacheattributetype;
    }
}
