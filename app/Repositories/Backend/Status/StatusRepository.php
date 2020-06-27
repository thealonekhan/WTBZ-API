<?php

namespace App\Repositories\Backend\Status;

use DB;
use Carbon\Carbon;
use App\Models\Status\Status;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusRepository.
 */
class StatusRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Status::class;

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
                config('module.statuses.table').'.id',
                config('module.statuses.table').'.created_at',
                config('module.statuses.table').'.updated_at',
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
        if (Status::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.statuses.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Status $status
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Status $status, array $input)
    {
    	if ($status->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.statuses.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Status $status
     * @throws GeneralException
     * @return bool
     */
    public function delete(Status $status)
    {
        if ($status->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.statuses.delete_error'));
    }
}
