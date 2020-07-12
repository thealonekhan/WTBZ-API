<?php

namespace App\Repositories\Backend\ZumhicacheLog;

use App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogCreated;
use App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogDeleted;
use App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheLog\ZumhiCacheLog;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheLogRepository.
 */
class ZumhiCacheLogRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheLog::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin(config('module.zumhicacheusers.table'), config('module.zumhicachelogs.table').'.user_id', '=', config('module.zumhicacheusers.table').'.id')
            ->select([
                config('module.zumhicachelogs.table').'.id',
                config('module.zumhicachelogs.table').'.referenceCode',
                config('module.zumhicachelogs.table').'.zumhicacheCode',
                config('module.zumhicacheusers.table').'.referenceCode as ownerCode',
                config('module.zumhicachelogs.table').'.created_at',
                config('module.zumhicachelogs.table').'.updated_at',
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
        $zumhicachelog = $this->createZumhicacheLogStub($request);

        DB::transaction(function () use ($zumhicachelog) {
            if ($zumhicachelog->save()) {
                event(new ZumhiCacheLogCreated($zumhicachelog));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicachelogs.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheLog $zumhicachelog
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicachelog = $this->createZumhicacheLogStub($request, $id);
    	DB::transaction(function () use ($zumhicachelog) {
            if ($zumhicachelog->save()) {
                event(new ZumhiCacheLogUpdated($zumhicachelog));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicachelogs.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheLog $zumhicachelog
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicachelog)
    {
        if ($zumhicachelog->delete()) {
            event(new ZumhiCacheLogDeleted($zumhicachelog));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachelogs.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheLogStub($input, $id=null)
    {
        $zumhicachelog = self::MODEL;
        if (!empty($id)) {
            $zumhicachelog = $zumhicachelog::findOrFail($id);
        } else {
            $zumhicachelog = new $zumhicachelog();
        }

        
        $zumhicachelog->referenceCode = $input['referenceCode'];
        $zumhicachelog->user_id = $input['user_id'];
        $zumhicachelog->zumhicacheCode = $input['zumhicacheCode'];
        $zumhicachelog->loggedDate = !empty($input['loggedDate']) ? Carbon::parse($input['loggedDate']) : null;
        $zumhicachelog->text = !empty($input['text']) ? $input['text'] : null;
        $zumhicachelog->logtype_id = $input['logtype_id'];
        $zumhicachelog->coordinates_id = !empty($input['coordinates_id']) ? $input['coordinates_id'] : null;
        $zumhicachelog->usedFavoritePoint = !empty($input['usedFavoritePoint']) ? $input['usedFavoritePoint'] : 0;
        $zumhicachelog->isEncoded = !empty($input['isEncoded']) ? $input['isEncoded'] : 0;
        $zumhicachelog->isArchived = !empty($input['isArchived']) ? $input['isArchived'] : 0;
        $zumhicachelog->url = !empty($input['url']) ? $input['url'] : 0;
        return $zumhicachelog;
    }
}
