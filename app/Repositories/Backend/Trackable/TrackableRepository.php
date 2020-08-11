<?php

namespace App\Repositories\Backend\Trackable;

use App\Events\Backend\Trackable\TrackableCreated;
use App\Events\Backend\Trackable\TrackableDeleted;
use App\Events\Backend\Trackable\TrackableUpdated;
use DB;
use Carbon\Carbon;
use App\Models\Trackable\Trackable;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrackableRepository.
 */
class TrackableRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Trackable::class;

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
                config('module.trackables.table').'.id',
                config('module.trackables.table').'.referenceCode',
                config('module.trackables.table').'.name',
                config('module.trackables.table').'.ownerCode',
                config('module.trackables.table').'.zumhiCode',
                config('module.trackables.table').'.created_at',
                config('module.trackables.table').'.updated_at',
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
        $trackable = $this->createTrackableStub($request);
        DB::transaction(function () use ($trackable) {
            if ($trackable->save()) {
                event(new TrackableCreated($trackable));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.trackables.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Trackable $trackable
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $trackable = $this->createTrackableStub($request, $id);
    	DB::transaction(function () use ($trackable) {
            if ($trackable->save()) {
                event(new TrackableUpdated($trackable));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.trackables.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Trackable $trackable
     * @throws GeneralException
     * @return bool
     */
    public function delete($trackable)
    {
        if ($trackable->delete()) {
            event(new TrackableDeleted($trackable));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.trackables.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createTrackableStub($input, $id=null)
    {
        $trackable = self::MODEL;
        if (!empty($id)) {
            $trackable = $trackable::findOrFail($id);
        } else {
            $trackable = new $trackable();
        }

        
        $trackable->referenceCode = $input['referenceCode'];
        $trackable->iconUrl = $input['iconUrl'];
        $trackable->name = $input['name'];
        $trackable->goal = $input['goal'];
        $trackable->description = $input['description'];
        $trackable->releasedDate = !empty($input['releasedDate']) ? Carbon::parse($input['releasedDate'])->toDateString() : null;
        $trackable->country_id = $input['country_id'];
        $trackable->ownerCode = $input['ownerCode'];
        $trackable->holderCode = $input['holderCode'];
        $trackable->inHolderCollection = $input['inHolderCollection'];
        $trackable->zumhiCode = $input['zumhiCode'];
        $trackable->isMissing = $input['isMissing'];
        $trackable->trackingNumber = $input['trackingNumber'];
        $trackable->kilometersTraveled = $input['kilometersTraveled'];
        $trackable->milesTraveled = $input['milesTraveled'];
        $trackable->type_id = $input['type_id'];
        $trackable->url = $input['url'];
        return $trackable;
    }
}
