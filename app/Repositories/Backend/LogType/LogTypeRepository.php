<?php

namespace App\Repositories\Backend\LogType;

use DB;
use Carbon\Carbon;
use App\Models\LogType\LogType;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogTypeRepository.
 */
class LogTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = LogType::class;

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
                config('module.logtypes.table').'.id',
                config('module.logtypes.table').'.name',
                config('module.logtypes.table').'.created_at',
                config('module.logtypes.table').'.updated_at',
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
        if (LogType::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.logtypes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param LogType $logtype
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(LogType $logtype, array $input)
    {
    	if ($logtype->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.logtypes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param LogType $logtype
     * @throws GeneralException
     * @return bool
     */
    public function delete(LogType $logtype)
    {
        if ($logtype->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.logtypes.delete_error'));
    }
}
