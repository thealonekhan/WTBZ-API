<?php

namespace App\Repositories\Backend\ZCList;

use App\Events\Backend\ZCList\ZCListCreated;
use App\Events\Backend\ZCList\ZCListDeleted;
use App\Events\Backend\ZCList\ZCListUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ZCList\ZCList;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZCListRepository.
 */
class ZCListRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZCList::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin(config('module.listtypes.table'), config('module.zclists.table').'.listtype_id', '=', config('module.listtypes.table').'.id')
            ->select([
                config('module.zclists.table').'.id',
                config('module.zclists.table').'.referenceCode',
                config('module.zclists.table').'.name',
                config('module.zclists.table').'.ownerCode',
                config('module.listtypes.table').'.name as ListType',
                config('module.zclists.table').'.created_at',
                config('module.zclists.table').'.updated_at',
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
        $zclist = $this->createZCListStub($request);

        DB::transaction(function () use ($zclist) {
            if ($zclist->save()) {
                event(new ZCListCreated($zclist));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zclists.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZCList $zclist
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zclist = $this->createZCListStub($request, $id);
    	DB::transaction(function () use ($zclist) {
            if ($zclist->save()) {
                event(new ZCListUpdated($zclist));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zclists.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZCList $zclist
     * @throws GeneralException
     * @return bool
     */
    public function delete($zclist)
    {
        if ($zclist) {
            $zclist->listzumhicache()->delete();
            $zclist->delete();
            event(new ZCListDeleted($zclist));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zclists.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZCListStub($input, $id=null)
    {
        $zclist = self::MODEL;
        if (!empty($id)) {
            $zclist = $zclist::findOrFail($id);
        } else {
            $zclist = new $zclist();
        }

        $zclist->referenceCode = $input['referenceCode'];
        $zclist->createdDateUtc = !empty($input['createdDateUtc']) ? Carbon::parse($input['createdDateUtc']) : null;
        $zclist->lastUpdatedDateUtc = !empty($input['lastUpdatedDateUtc']) ? Carbon::parse($input['lastUpdatedDateUtc']) : null;
        $zclist->name = !empty($input['name']) ? $input['name'] : null;
        $zclist->ownerCode = $input['ownerCode'];
        $zclist->description = !empty($input['description']) ? $input['description'] : null;
        $zclist->listtype_id = $input['typeId'];
        $zclist->isShared = !empty($input['isShared']) ? $input['isShared'] : 0;
        $zclist->isPublic = !empty($input['isPublic']) ? $input['isPublic'] : 0;
        $zclist->url = !empty($input['url']) ? $input['url'] : null;
        return $zclist;
    }
}
