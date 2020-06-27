<?php

namespace App\Repositories\Backend\Zumhicache;

use App\Events\Backend\ZumhiCache\ZumhiCacheCreated;
use App\Events\Backend\ZumhiCache\ZumhiCacheDeleted;
use App\Events\Backend\ZumhiCache\ZumhiCacheUpdated;
use DB;
use Carbon\Carbon;
use App\Models\Zumhicache\ZumhiCache;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheRepository.
 */
class ZumhiCacheRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCache::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
        ->leftJoin(config('module.statuses.table'), config('module.zumhicaches.table').'.status_id', '=', config('module.statuses.table').'.id')
            ->select([
                config('module.zumhicaches.table').'.id',
                config('module.zumhicaches.table').'.referenceCode',
                config('module.zumhicaches.table').'.name',
                config('module.statuses.table').'.name as status',
                config('module.zumhicaches.table').'.created_at',
                config('module.zumhicaches.table').'.updated_at',
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
        $zumhicache = $this->createZumhicacheStub($request);

        DB::transaction(function () use ($zumhicache) {
            if ($zumhicache->save()) {
                event(new ZumhiCacheCreated($zumhicache));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicaches.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCache $zumhicache
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicache = $this->createZumhicacheStub($request, $id);
    	DB::transaction(function () use ($zumhicache) {
            if ($zumhicache->save()) {
                event(new ZumhiCacheUpdated($zumhicache));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicaches.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCache $zumhicache
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicache)
    {
        if ($zumhicache->delete()) {
            event(new ZumhiCacheDeleted($zumhicache));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicaches.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheStub($input, $id=null)
    {
        $zumhicache = self::MODEL;
        if (!empty($id)) {
            $zumhicache = $zumhicache::findOrFail($id);
        } else {
            $zumhicache = new $zumhicache();
        }
        
        $zumhicache->referenceCode = $input['referenceCode'];
        $zumhicache->name = $input['name'];
        $zumhicache->difficulty = $input['difficulty'];
        $zumhicache->terrain = $input['terrain'];
        $zumhicache->placedDate = !empty($input['placedDate']) ? Carbon::parse($input['placedDate']) : null;
        $zumhicache->publishedDate = !empty($input['publishedDate']) ? Carbon::parse($input['publishedDate']) : null;
        $zumhicache->eventEndDate = !empty($input['eventEndDate']) ? Carbon::parse($input['eventEndDate']) : null;
        $zumhicache->user_id = $input['user_id'];
        $zumhicache->type_id = $input['type_id'];
        $zumhicache->size_id = $input['size_id'];
        $zumhicache->country_id = $input['country_id'];
        $zumhicache->state_id = $input['state_id'];
        $zumhicache->coordinates_id = $input['coordinates_id'];
        $zumhicache->shortDescription = $input['shortDescription'];
        $zumhicache->longDescription = $input['longDescription'];
        $zumhicache->hints = $input['hints'];
        $zumhicache->ianaTimezoneId = $input['ianaTimezoneId'];
        $zumhicache->relatedWebPage = $input['relatedWebPage'];
        $zumhicache->url = $input['url'];
        $zumhicache->containsHtml = !empty($input['containsHtml']) ? $input['containsHtml'] : null;
        $zumhicache->hasSolutionChecker = !empty($input['hasSolutionChecker']) ? $input['hasSolutionChecker'] : null;
        $zumhicache->status_id = $input['status_id'];
        return $zumhicache;
    }
}
