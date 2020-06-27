<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(MembershipsTableSeeder::class);
        $this->call(CoordinatesSeeder::class);

        Model::reguard();
    }
}
