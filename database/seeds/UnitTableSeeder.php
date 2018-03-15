<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // this is super dirty db populater for Units
    {
        $exist = DB::table('units')->max('id');
        $count = 1;
        while ($count <= 1742) {
            DB::table('units')->insert([
                'id' => $count + $exist,
                'building_id' => random_int(1,2), //randomly assign to building 1 or 2, can modify for testing
                'name' => random_int(0, 9).random_int(0,4) . '0' . random_int(0, 9),
                'renter' => 'emorystudent' . str_random(2),
                'file' => str_random(10),
                'maintenance' => str_random(10),
                'rent' => '812.99',
                'gas' => '50.23',
                'water' => '75.34',
                'electricity' => '102.54',
                'damages' => '21.23',
                'created_at' => '2017-12-02 00:03:11',
                'updated_at' => '2017-12-02 00:03:11',
            ]);
            $count++;
        }
    }
}
