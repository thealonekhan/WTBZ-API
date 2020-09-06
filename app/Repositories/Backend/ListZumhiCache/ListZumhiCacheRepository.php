<?php

namespace App\Repositories\Backend\ListZumhiCache;

use App\Events\Backend\ListZumhiCache\ListZumhiCacheCreated;
use App\Events\Backend\ListZumhiCache\ListZumhiCacheDeleted;
use App\Events\Backend\ListZumhiCache\ListZumhiCacheUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ListZumhiCache\ListZumhiCache;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListZumhiCacheRepository.
 */
class ListZumhiCacheRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ListZumhiCache::class;

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
                config('module.listzumhicaches.table').'.id',
                config('module.listzumhicaches.table').'.listItemName',
                config('module.listzumhicaches.table').'.zumhiCode',
                config('module.listzumhicaches.table').'.listCode',
                config('module.listzumhicaches.table').'.created_at',
                config('module.listzumhicaches.table').'.updated_at',
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
        $listzumhicache = $this->createListZumhiCacheStub($request);

        DB::transaction(function () use ($listzumhicache) {
            if ($listzumhicache->save()) {
                event(new ListZumhiCacheCreated($listzumhicache));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.listzumhicaches.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ListZumhiCache $listzumhicache
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
    	$listzumhicache = $this->createListZumhiCacheStub($request, $id);
    	DB::transaction(function () use ($listzumhicache) {
            if ($listzumhicache->save()) {
                event(new ListZumhiCacheUpdated($listzumhicache));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.listzumhicaches.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ListZumhiCache $listzumhicache
     * @throws GeneralException
     * @return bool
     */
    public function delete($listzumhicache)
    {
        if ($listzumhicache->delete()) {
            event(new ListZumhiCacheDeleted($listzumhicache));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.listzumhicaches.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createListZumhiCacheStub($input, $id=null)
    {
        $listzumhicache = self::MODEL;
        if (!empty($id)) {
            $listzumhicache = $listzumhicache::findOrFail($id);
        } else {
            $listzumhicache = new $listzumhicache();
        }

        $listzumhicache->listItemName = $input['listItemName'];
        $listzumhicache->listCode = $input['listCode'];
        $listzumhicache->zumhiCode = $input['zumhiCode'];
        return $listzumhicache;
    }
}
