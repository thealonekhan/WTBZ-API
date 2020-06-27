<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordinatesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('module.zumhicachecoordinates.table'));

        $coordinates = [
            [
                'latitude'       => '63.5',
                'longitude'       => '-154.4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'latitude'       => '32.3',
                'longitude'       => '-86.9',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'latitude'       => '43.2',
                'longitude'       => '-74.2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'latitude'       => '36.7',
                'longitude'       => '-119.4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'latitude'       => '39.3',
                'longitude'       => '-111.0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'latitude'       => '47.5',
                'longitude'       => '-122.5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table(config('module.zumhicachecoordinates.table'))->insert($coordinates);

        $this->enableForeignKeys();
    }
}
