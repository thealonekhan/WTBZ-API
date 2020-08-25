<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\UserWayPointResource;
use Illuminate\Http\Request;
use App\Models\UserWayPoint\UserWayPoint;
use App\Repositories\Backend\UserWayPoint\UserWayPointRepository;
use App\Helpers\APIHelper;
use Validator;
use DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class UserWayPointController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserWayPointRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 100;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  UserWayPointResource::collection(
            UserWayPoint::with(['zumhicache', 'coordinate'])
            // ->where('referenceCode', $referenceCode)
            ->take($take)
            ->skip($skip)
            ->get()
        );

        if ($fields) {
            $collections = $collections->map->only(APIHelper::formatRefCodes($fields));
        }

        return $collections;


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zumhicacheUserWayPoint(Request $request, $referenceCode)
    {
        $fields = $request->get('fields') ? $request->get('fields') : null;
        $take = $request->get('take') ? $request->get('take') : 50;
        $skip = $request->get('skip') ? $request->get('skip') : 0;

        $collections =  UserWayPointResource::collection(
            UserWayPoint::with(['zumhicache', 'coordinate'])
            ->where('zumhiCode', $referenceCode)
            ->take($take)
            ->skip($skip)
            ->get()
        );

        if ($fields) {
            $collections = $collections->map->only(APIHelper::formatRefCodes($fields));
        }

        return $collections;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zumhicacheCorrectedCoordinatesUpsert(Request $request, $referenceCode)
    {
        $validation = $this->validatePointsUpsert($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->upsert($referenceCode, $request->all());

        return new UserWayPointResource(UserWayPoint::orderBy('created_at', 'desc')->first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validatePoints($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new UserWayPointResource(UserWayPoint::orderBy('created_at', 'desc')->first());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($referenceCode)
    {
        // $lite = request()->lite ? request()->lite : 'false';
        $fields = request()->fields ? request()->fields : null;

        $collections =  UserWayPointResource::collection(
            TrackableLog::with(['trackable', 'owner', 'zumhicache', 'trackableLogType', 'coordinate'])
            ->where('referenceCode', $referenceCode)
            ->get()
        )->first();

        if ($fields) {
            $collections = $collections->only(APIHelper::formatRefCodes($fields));
        }

        return $collections;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $referenceCode)
    {
        $userwaypoint = UserWayPoint::where('referenceCode', $referenceCode)->first();

        if ($userwaypoint) {
            $validation = $this->validatePoints($request, 'update', $userwaypoint->id);

            if ($validation->fails()) {
                return $this->throwValidation($validation->messages()->first());
            }

            $this->repository->update($userwaypoint->id, $request->all());


            return new UserWayPointResource(UserWayPoint::findOrFail($userwaypoint->id));
        }

        return $this->respond([
            'message' => trans('exceptions.backend.userwaypoints.update_error'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($referenceCode)
    {
        $userwaypoint = UserWayPoint::where('referenceCode', $referenceCode)->first();
        if ($userwaypoint) {
            $this->repository->delete($userwaypoint);
            return $this->respond([
                'message' => trans('alerts.backend.userwaypoints.deleted'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.userwaypoints.delete_error'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function zumhicacheCorrectedCoordinatesDelete($referenceCode)
    {
        $userwaypointCheck = UserWayPoint::where('zumhiCode', $referenceCode)->first();
        if ($userwaypointCheck ) {
            UserWayPoint::where('zumhiCode', $referenceCode)->update(['coordinates_id' => NULL]);
            return $this->respond([
                'message' => trans('alerts.backend.userwaypoints.deleted_coordinates'),
            ]);
        }

        return $this->respond([
            'message' => trans('exceptions.backend.userwaypoints.delete_error'),
        ]);
    }

    /**
     * validate USerWayPoints.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePoints(Request $request, $action = 'insert', $userwaypointID=null)
    {
        $referenceCode = '';
        if ($action == 'insert') {
            $referenceCode = 'required|max:36|unique:userwaypoints';
        }
        if ($action == 'update') {
            $referenceCode = [
                'required',
                'max:36',
                Rule::unique('userwaypoints')->ignore($userwaypointID),
            ];
        }



        $validation = Validator::make($request->all(), [
            'referenceCode'             => $referenceCode,
            'description'               => 'required',
            'isCorrectedCoordinates'    => 'nullable|boolean',
            'coordinates_id'            => 'nullable|integer|exists:zumhicachecoordinates,id',
            'zumhicacheCode'            => 'required|exists:zumhi_caches,referenceCode',
        ]);

        return $validation;

    }
    
    /**
     * validate UserWayPoint Upsert.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePointsUpsert(Request $request, $action = 'insert', $userwaypointID=null)
    {
        $validation = Validator::make($request->all(), [
            'coordinates_id' => 'required|integer|exists:zumhicachecoordinates,id',
        ]);

        return $validation;

    }
}
