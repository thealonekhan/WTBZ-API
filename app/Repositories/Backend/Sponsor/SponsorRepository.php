<?php

namespace App\Repositories\Backend\Sponsor;

use App\Events\Backend\Sponsor\SponsorCreated;
use App\Events\Backend\Sponsor\SponsorDeleted;
use App\Events\Backend\Sponsor\SponsorUpdated;
use DB;
use Carbon\Carbon;
use App\Models\Sponsor\Sponsor;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SponsorRepository.
 */
class SponsorRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Sponsor::class;

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
                config('module.sponsors.table').'.id',
                config('module.sponsors.table').'.name',
                config('module.sponsors.table').'.created_at',
                config('module.sponsors.table').'.updated_at',
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
        $sponsor = $this->createSponsorStub($request);
        DB::transaction(function () use ($sponsor) {
            if ($sponsor->save()) {
                event(new SponsorCreated($sponsor));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.sponsors.create_error'));
        });
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Sponsor $sponsor
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update($id, array $request)
    {
        $sponsor = $this->createSponsorStub($request, $id);
    	DB::transaction(function () use ($sponsor) {
            if ($sponsor->save()) {
                event(new SponsorUpdated($sponsor));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.sponsors.update_error'));
        });
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Sponsor $sponsor
     * @throws GeneralException
     * @return bool
     */
    public function delete($sponsor)
    {
        if ($sponsor->delete()) {
            event(new SponsorDeleted($sponsor));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.sponsors.delete_error'));
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createSponsorStub($input, $id=null)
    {
        $sponsor = self::MODEL;
        if (!empty($id)) {
            $sponsor = $sponsor::findOrFail($id);
        } else {
            $sponsor = new $sponsor();
        }

        
        $sponsor->name = $input['name'];
        $sponsor->relatedWebPage = !empty($input['relatedWebPage']) ? $input['relatedWebPage'] : 0;
        $sponsor->relatedWebPageText = !empty($input['relatedWebPageText']) ? $input['relatedWebPageText'] : 0;
        return $sponsor;
    }
}
