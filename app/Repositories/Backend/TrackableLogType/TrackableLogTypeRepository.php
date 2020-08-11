<?php

namespace App\Repositories\Backend\TrackableLogType;

use DB;
use Carbon\Carbon;
use App\Models\TrackableLogType\TrackableLogType;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrackableLogTypeRepository.
 */
class TrackableLogTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = TrackableLogType::class;

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
                config('module.trackablelogtypes.table').'.id',
                config('module.trackablelogtypes.table').'.name',
                config('module.trackablelogtypes.table').'.created_at',
                config('module.trackablelogtypes.table').'.updated_at',
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
        if (TrackableLogType::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.trackablelogtypes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param TrackableLogType $trackablelogtype
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(TrackableLogType $trackablelogtype, array $input)
    {
    	if ($trackablelogtype->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.trackablelogtypes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param TrackableLogType $trackablelogtype
     * @throws GeneralException
     * @return bool
     */
    public function delete(TrackableLogType $trackablelogtype)
    {
        if ($trackablelogtype->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.trackablelogtypes.delete_error'));
    }
}
