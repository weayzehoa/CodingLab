<?php

use Illuminate\Database\Seeder;
use App\Park as ParkEloquent;

class ParksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parks = DB::connection('parktaipei')->table('parkmanagement')->get();

        foreach ($parks as $park) {
            ParkEloquent::create([
                 'name'     => $park->pm_name,
                 'engname'     => $park->pm_name_eng,
                 'overview'    => $park->pm_overview,
                 'lat'    => $park->pm_lat,
                 'lon'    => $park->pm_lon,
                 'dist'    => $park->pm_regions,
                 'location'    => $park->pm_location,
                 'type'    => $park->pm_type,
                 'unit'    => $park->pm_unit,
                 'onlinedate'    => date('Y-m-d H:i:s'),
                 'isshow' => 1,
                 'created_at' => date('Y-m-d H:i:s'),
             ]);
        }
    }
}
