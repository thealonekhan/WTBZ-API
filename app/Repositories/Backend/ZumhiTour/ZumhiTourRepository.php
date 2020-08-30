<?php

namespace App\Repositories\Backend\ZumhiTour;

use App\Events\Backend\ZumhiTour\ZumhiTourCreated;
use App\Events\Backend\ZumhiTour\ZumhiTourDeleted;
use App\Events\Backend\ZumhiTour\ZumhiTourUpdated;
use DB;
use Carbon\Carbon;
use App\Models\ZumhiTour\ZumhiTour;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZumhiTourRepository.
 */
class ZumhiTourRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ZumhiTour::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin(config('module.sponsors.table'), config('module.zumhitours.table').'.sponsor_id', '=', config('module.sponsors.table').'.id')
            ->select([
                config('module.zumhitours.table').'.id',
                config('module.zumhitours.table').'.referenceCode',
                config('module.zumhitours.table').'.name',
                config('module.sponsors.table').'.name as sponsor',
                config('module.zumhitours.table').'.created_at',
                config('module.zumhitours.table').'.updated_at',
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
        $zumhicacheArray = $request['zumhicaches'];
        unset($request['zumhicaches']);
        $zumhitour = $this->createZumhiTourStub($request);

        DB::transaction(function () use ($zumhitour, $zumhicacheArray) {
            if ($zumhitour->save()) {

                if (count($zumhicacheArray)) {
                    $zumhitour->zumhicaches()->sync($zumhicacheArray);
                }

                event(new ZumhiTourCreated($zumhitour));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhitours.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ZumhiTour $zumhitour
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $zumhicacheArray = $request['zumhicaches'];
        unset($request['zumhicaches']);
        $zumhitour = $this->createZumhiTourStub($request, $id);
        DB::transaction(function () use ($zumhitour, $zumhicacheArray) {
            if ($zumhitour->save()) {

                if (count($zumhicacheArray)) {
                    $zumhitour->zumhicaches()->sync($zumhicacheArray);
                }

                event(new ZumhiTourUpdated($zumhitour));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.zumhitours.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ZumhiTour $zumhitour
     * @throws GeneralException
     * @return bool
     */
    public function delete($zumhitour)
    {
        if ($zumhitour->delete()) {
            event(new ZumhiTourDeleted($zumhitour));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.zumhitours.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createZumhiTourStub($input, $id=null)
    {
        $zumhitour = self::MODEL;
        if (!empty($id)) {
            $zumhitour = $zumhitour::findOrFail($id);
        } else {
            $zumhitour = new $zumhitour();
        }
        
        $zumhitour->referenceCode = $input['referenceCode'];
        $zumhitour->name = $input['name'];
        $zumhitour->coordinates_id = $input['coordinates_id'];
        $zumhitour->sponsor_id = $input['sponsor_id'];
        $zumhitour->description = $input['description'];
        $zumhitour->coverImageUrl = $input['coverImageUrl'];
        $zumhitour->logoImageUrl = $input['logoImageUrl'];
        $zumhitour->url = $input['url'];
        return $zumhitour;
    }
}
