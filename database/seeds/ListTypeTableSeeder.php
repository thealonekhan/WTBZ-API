<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListTypeTableSeeder extends Seeder
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
        $this->truncate(config('module.listtypes.table'));

        $types = [
            [
                'name'       => 'Pocket Query (pq)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Bookmark (bm)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Ignore (il)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Watch (wl)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Favorites (fl)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table(config('module.listtypes.table'))->insert($types);
        $this->enableForeignKeys();
    }
}
