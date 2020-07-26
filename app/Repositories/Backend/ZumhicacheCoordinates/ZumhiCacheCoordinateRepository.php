<?php

namespace App\Repositories\Backend\ZumhicacheCoordinates;

use App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateCreated;
use App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateDeleted;
use App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateUpdated;
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
                config('module.zumhicachecoordinates.table').'.latitude',
                config('module.zumhicachecoordinates.table').'.longitude',
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
    public function create(array $request)
    {
        $zumhicachecoordinate = $this->createZumhicacheCoordinateStub($request);
        DB::transaction(function () use ($zumhicachecoordinate) {
            if ($zumhicachecoordinate->save()) {
                event(new ZumhiCacheCoordinateCreated($zumhicachecoordinate));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheCoordinate $zumhicachecoordinate
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicachecoordinate = $this->createZumhicacheCoordinateStub($request, $id);
    	DB::transaction(function () use ($zumhicachecoordinate) {
            if ($zumhicachecoordinate->save()) {
                event(new ZumhiCacheCoordinateUpdated($zumhicachecoordinate));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheCoordinate $zumhicachecoordinate
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicachecoordinate)
    {
        if ($zumhicachecoordinate->delete()) {
            event(new ZumhiCacheCoordinateDeleted($zumhicachecoordinate));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicachecoordinates.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheCoordinateStub($input, $id=null)
    {
        $zumhicachecoordinate = self::MODEL;
        if (!empty($id)) {
            $zumhicachecoordinate = $zumhicachecoordinate::findOrFail($id);
        } else {
            $zumhicachecoordinate = new $zumhicachecoordinate();
        }

        
        $zumhicachecoordinate->latitude = $input['latitude'];
        $zumhicachecoordinate->longitude = $input['longitude'];
        return $zumhicachecoordinate;
    }
}
