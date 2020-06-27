<?php

namespace App\Repositories\Backend\ZumhicacheUser;

use App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserCreated;
use App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserDeleted;
use App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiCacheUserRepository.
 */
class ZumhiCacheUserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiCacheUser::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin(config('access.users_table'), config('module.zumhicacheusers.table').'.user_id', '=', config('access.users_table').'.id')
            ->leftJoin(config('module.zumhicachememberships.table'), config('module.zumhicacheusers.table').'.membership_id', '=', config('module.zumhicachememberships.table').'.id')
            ->select([
                config('module.zumhicacheusers.table').'.id',
                config('module.zumhicacheusers.table').'.referenceCode',
                config('access.users_table').'.username as Username',
                config('module.zumhicachememberships.table').'.name as Membership',
                config('module.zumhicacheusers.table').'.created_at',
                config('module.zumhicacheusers.table').'.updated_at',
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
        $zumhicacheuser = $this->createZumhicacheUserStub($request);

        DB::transaction(function () use ($zumhicacheuser) {
            if ($zumhicacheuser->save()) {
                event(new ZumhiCacheUserCreated($zumhicacheuser));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheusers.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiCacheUser $zumhicacheuser
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicacheuser = $this->createZumhicacheUserStub($request, $id);
    	DB::transaction(function () use ($zumhicacheuser) {
            if ($zumhicacheuser->save()) {
                event(new ZumhiCacheUserUpdated($zumhicacheuser));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhicacheusers.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiCacheUser $zumhicacheuser
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhicacheuser)
    {   
        if ($zumhicacheuser->delete()) {
            event(new ZumhiCacheUserDeleted($zumhicacheuser));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhicacheusers.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhicacheUserStub($input, $id=null)
    {
        $zumhicacheuser = self::MODEL;
        if (!empty($id)) {
            $zumhicacheuser = $zumhicacheuser::findOrFail($id);
        } else {
            $zumhicacheuser = new $zumhicacheuser();
        }

        
        $zumhicacheuser->referenceCode = $input['referenceCode'];
        $zumhicacheuser->user_id = $input['user_id'];
        $zumhicacheuser->membership_id = $input['membership_id'];
        $zumhicacheuser->joinedDateUtc = !empty($input['joinedDateUtc']) ? Carbon::parse($input['joinedDateUtc']) : null;
        $zumhicacheuser->avatarUrl = $input['avatarUrl'];
        $zumhicacheuser->bannerUrl = $input['bannerUrl'];
        $zumhicacheuser->url = $input['url'];
        $zumhicacheuser->profileText = $input['profileText'];
        $zumhicacheuser->coordinates_id = $input['coordinates_id'];
        $zumhicacheuser->isFriend = $input['isFriend'];
        $zumhicacheuser->optedInFriendSharing = $input['optedInFriendSharing'];
        return $zumhicacheuser;
    }
}
