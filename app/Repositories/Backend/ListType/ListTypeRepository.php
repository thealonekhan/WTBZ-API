<?php

namespace App\Repositories\Backend\ListType;

use DB;
use Carbon\Carbon;
use App\Models\ListType\ListType;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListTypeRepository.
 */
class ListTypeRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ListType::class;

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
                config('module.listtypes.table').'.id',
                config('module.listtypes.table').'.name',
                config('module.listtypes.table').'.created_at',
                config('module.listtypes.table').'.updated_at',
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
        if (ListType::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.listtypes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ListType $listtype
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ListType $listtype, array $input)
    {
    	if ($listtype->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.listtypes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ListType $listtype
     * @throws GeneralException
     * @return bool
     */
    public function delete(ListType $listtype)
    {
        if ($listtype->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.listtypes.delete_error'));
    }
}
