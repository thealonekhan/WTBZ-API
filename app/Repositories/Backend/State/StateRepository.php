<?php

namespace App\Repositories\Backend\State;

use DB;
use Carbon\Carbon;
use App\Models\State\State;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StateRepository.
 */
class StateRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = State::class;

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
                config('module.states.table').'.id',
                config('module.states.table').'.created_at',
                config('module.states.table').'.updated_at',
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
        if (State::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.states.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param State $state
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(State $state, array $input)
    {
    	if ($state->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.states.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param State $state
     * @throws GeneralException
     * @return bool
     */
    public function delete(State $state)
    {
        if ($state->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.states.delete_error'));
    }
}
