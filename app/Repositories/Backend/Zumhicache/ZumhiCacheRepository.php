<?php

namespace App\Repositories\Backend\Zumhicache;

use App\Events\Backend\ZumhiCache\ZumhiCacheCreated;
use App\Events\Backend\ZumhiCache\ZumhiCacheDeleted;
use App\Events\Backend\ZumhiCache\ZumhiCacheUpdated;
use DB;
use Carbon\Carbon;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
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
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForAPI()
    {
        return $this->query()
        // ->leftJoin(config('module.zumhicachetypes.table'), config('module.zumhicaches.table').'.type_id', '=', config('module.zumhicachetypes.table').'.id')
        // ->leftJoin(config('module.zumhicachesizes.table'), config('module.zumhicaches.table').'.size_id', '=', config('module.zumhicachesizes.table').'.id')
        ->leftJoin(config('module.statuses.table'), config('module.zumhicaches.table').'.status_id', '=', config('module.statuses.table').'.id')
            ->select([
                config('module.zumhicaches.table').'.referenceCode',
                config('module.zumhicaches.table').'.name',
                config('module.zumhicaches.table').'.difficulty',
                config('module.zumhicaches.table').'.terrain',
                config('module.zumhicaches.table').'.placedDate',
                config('module.zumhicaches.table').'.publishedDate',
                config('module.zumhicaches.table').'.eventEndDate',
                config('module.zumhicaches.table').'.lastVisitedDate',
                config('module.zumhicaches.table').'.shortDescription',
                config('module.zumhicaches.table').'.longDescription',
                config('module.zumhicaches.table').'.hints',
                config('module.zumhicaches.table').'.ianaTimezoneId',
                config('module.zumhicaches.table').'.relatedWebPage',
                config('module.zumhicaches.table').'.url',
                config('module.zumhicaches.table').'.containsHtml',
                config('module.zumhicaches.table').'.hasSolutionChecker',
                config('module.statuses.table').'.name as status',
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
        $attributesArray = $this->createAttributes($request['attributes']);
        unset($request['attributes']);
        $zumhicache = $this->createZumhicacheStub($request);

        $coordinates_id = $this->checkCoordinates($request['coordinates_id']);
        
        $zumhicache->coordinates_id = $coordinates_id;
        
        DB::transaction(function () use ($zumhicache, $attributesArray) {
            if ($zumhicache->save()) {

                if (count($attributesArray)) {
                    $zumhicache->attributes()->sync($attributesArray);
                }

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
        $attributesArray = $this->createAttributes($request['attributes']);
        unset($request['attributes']);
        $zumhicache = $this->createZumhicacheStub($request, $id);

        $coordinates_id = $this->checkCoordinates($request['coordinates_id']);
        
        $zumhicache->coordinates_id = $coordinates_id;

    	DB::transaction(function () use ($zumhicache, $attributesArray) {
            if ($zumhicache->save()) {

                if (count($attributesArray)) {
                    $zumhicache->attributes()->sync($attributesArray);
                }

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
     * For updating the respective Model in storage
     *
     * @param ZumhiCache $zumhicache
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function changeStatus(array $request)
    {
        
        $zumhicache = self::MODEL;
        $zumhicache = $zumhicache::where('referenceCode', $request['zumhicacheCode'])->first();
        $zumhicache->status_id = $request['status_id'];
    	DB::transaction(function () use ($zumhicache) {
            if ($zumhicache->save()) {
                event(new ZumhiCacheUpdated($zumhicache));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicaches.update_error'));
        });
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
        // $zumhicache->coordinates_id = $input['coordinates_id'];
        $zumhicache->shortDescription = $input['shortDescription'];
        $zumhicache->longDescription = $input['longDescription'];
        $zumhicache->hints = $input['hints'];
        $zumhicache->ianaTimezoneId = $input['ianaTimezoneId'];
        $zumhicache->relatedWebPage = $input['relatedWebPage'];
        $zumhicache->url = $input['url'];
        $zumhicache->isPremiumOnly = !empty($input['isPremiumOnly']) ? $input['isPremiumOnly'] : null;
        $zumhicache->containsHtml = !empty($input['containsHtml']) ? $input['containsHtml'] : null;
        $zumhicache->hasSolutionChecker = !empty($input['hasSolutionChecker']) ? $input['hasSolutionChecker'] : null;
        $zumhicache->status_id = $input['status_id'];
        return $zumhicache;
    }

    /**
     * Creating ZumhiCacheAttributes.
     *
     * @param Array($attributes)
     *
     * @return array
     */
    public function createAttributes($attributes)
    {
        //Creating a new array for attributes (newly created)
        $attributes_array = [];

        foreach ($attributes as $attribute) {
            if (is_numeric($attribute)) {
                $attributes_array[] = $attribute;
            } else {
                $newAttribute = new ZumhiCacheAttribute();
                $newAttribute->name = $attribute;
                $newAttribute->isOn = 1;
                $newAttribute->save();

                $attributes_array[] = $newAttribute->id;
            }
        }

        return $attributes_array;
    }
    
    /**
     * Checking coordinates for existing or new.
     *
     * @param string($coordinates_id)
     *
     * @return string $coordinates_id
     */
    public function checkCoordinates($coordinates_id)
    {
        $coordinatesArray = explode(',', $coordinates_id);

        if (is_array($coordinatesArray) && count($coordinatesArray) > 1) {
            
            $coordinates = new ZumhiCacheCoordinate();
            $coordinates->latitude = $coordinatesArray[0];
            $coordinates->longitude = $coordinatesArray[1];
            $coordinates->save();

            $coordinates_id = $coordinates->id;
        }
        return $coordinates_id;
    }
}
