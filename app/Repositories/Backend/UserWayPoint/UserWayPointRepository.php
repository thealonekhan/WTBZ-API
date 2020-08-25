<?php

namespace App\Repositories\Backend\UserWayPoint;

use App\Events\Backend\UserWayPoint\UserWayPointCreated;
use App\Events\Backend\UserWayPoint\UserWayPointDeleted;
use App\Events\Backend\UserWayPoint\UserWayPointUpdated;
use DB;
use Carbon\Carbon;
use App\Models\UserWayPoint\UserWayPoint;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserWayPointRepository.
 */
class UserWayPointRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = UserWayPoint::class;

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
                config('module.userwaypoints.table').'.id',
                config('module.userwaypoints.table').'.referenceCode',
                config('module.userwaypoints.table').'.zumhiCode',
                config('module.userwaypoints.table').'.isCorrectedCoordinates',
                config('module.userwaypoints.table').'.created_at',
                config('module.userwaypoints.table').'.updated_at',
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
        $userwaypoint = $this->createUserWayPointStub($request);

        DB::transaction(function () use ($userwaypoint) {
            if ($userwaypoint->save()) {
                event(new UserWayPointCreated($userwaypoint));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.userwaypoints.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param UserWayPoint $userwaypoint
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $userwaypoint = $this->createUserWayPointStub($request, $id);
    	DB::transaction(function () use ($userwaypoint) {
            if ($userwaypoint->save()) {
                event(new UserWayPointUpdated($userwaypoint));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.userwaypoints.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param UserWayPoint $userwaypoint
     * @throws GeneralException
     * @return bool
     */
    public function delete($userwaypoint)
    {
        if ($userwaypoint->delete()) {
            event(new UserWayPointDeleted($userwaypoint));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.userwaypoints.delete_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param UserWayPoint $userwaypoint
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function upsert($zumhiCode, array $request)
    {
        $userwaypoints = self::MODEL;
        $userwaypoints = UserWayPoint::where('zumhiCode', $zumhiCode)->get();
    	DB::transaction(function () use ($userwaypoints, $request) {
            foreach ($userwaypoints as $userwaypoint) {
                $userwaypointupdate = self::MODEL;
                $userwaypointupdate = $userwaypointupdate::findOrFail($userwaypoint->id);
                $userwaypointupdate->coordinates_id = $request['coordinates_id'];
                $userwaypointupdate->save();
                event(new UserWayPointUpdated($userwaypointupdate));
            }
            return true;
        });
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserWayPointStub($input, $id=null)
    {
        $userwaypoint = self::MODEL;
        if (!empty($id)) {
            $userwaypoint = $userwaypoint::findOrFail($id);
        } else {
            $userwaypoint = new $userwaypoint();
        }

        $userwaypoint->referenceCode = $input['referenceCode'];
        $userwaypoint->zumhiCode = $input['zumhicacheCode'];
        $userwaypoint->description = !empty($input['description']) ? $input['description'] : null;
        $userwaypoint->isCorrectedCoordinates = !empty($input['isCorrectedCoordinates']) ? $input['isCorrectedCoordinates'] : 0;
        $userwaypoint->coordinates_id = !empty($input['coordinates_id']) ? $input['coordinates_id'] : null;
        return $userwaypoint;
    }
}
