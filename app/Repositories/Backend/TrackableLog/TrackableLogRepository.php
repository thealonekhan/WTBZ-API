<?php

namespace App\Repositories\Backend\TrackableLog;

use App\Events\Backend\TrackableLog\TrackableLogCreated;
use App\Events\Backend\TrackableLog\TrackableLogDeleted;
use App\Events\Backend\TrackableLog\TrackableLogUpdated;
use DB;
use Carbon\Carbon;
use App\Models\TrackableLog\TrackableLog;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrackableLogRepository.
 */
class TrackableLogRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = TrackableLog::class;

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
                config('module.trackablelogs.table').'.id',
                config('module.trackablelogs.table').'.referenceCode',
                config('module.trackablelogs.table').'.ownerCode',
                config('module.trackablelogs.table').'.trackableCode',
                config('module.trackablelogs.table').'.zumhiCode',
                config('module.trackablelogs.table').'.created_at',
                config('module.trackablelogs.table').'.updated_at',
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
        $trackablelog = $this->createTrackableLogStub($request);

        DB::transaction(function () use ($trackablelog) {
            if ($trackablelog->save()) {
                event(new TrackableLogCreated($trackablelog));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.trackablelogs.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param TrackableLog $trackablelog
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $trackablelog = $this->createTrackableLogStub($request, $id);
    	DB::transaction(function () use ($trackablelog) {
            if ($trackablelog->save()) {
                event(new TrackableLogUpdated($trackablelog));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.trackablelogs.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param TrackableLog $trackablelog
     * @throws GeneralException
     * @return bool
     */
    public function delete($trackablelog)
    {
        if ($trackablelog->delete()) {
            event(new TrackableLogDeleted($trackablelog));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.trackablelogs.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createTrackableLogStub($input, $id=null)
    {
        $trackablelog = self::MODEL;
        if (!empty($id)) {
            $trackablelog = $trackablelog::findOrFail($id);
        } else {
            $trackablelog = new $trackablelog();
        }

        
        $trackablelog->referenceCode = $input['referenceCode'];
        $trackablelog->ownerCode = $input['ownerCode'];
        $trackablelog->trackableCode = $input['trackableCode'];
        $trackablelog->zumhiCode = $input['zumhicacheCode'];
        $trackablelog->logDate = !empty($input['logDate']) ? Carbon::parse($input['logDate'])->toDateString() : null;
        $trackablelog->text = !empty($input['text']) ? $input['text'] : null;
        $trackablelog->isRot13Encoded = !empty($input['isRot13Encoded']) ? $input['isRot13Encoded'] : 0;
        $trackablelog->trackableLogTypeId = $input['trackableLogTypeId'];
        $trackablelog->coordinates_id = !empty($input['coordinates_id']) ? $input['coordinates_id'] : null;
        $trackablelog->trackingNumber = !empty($input['trackingNumber']) ? $input['trackingNumber'] : null;
        $trackablelog->url = !empty($input['url']) ? $input['url'] : null;
        return $trackablelog;
    }
}
