<?php

use Illuminate\Database\Seeder;

class ConcessionariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Concessionaire::create(['name' =>'toyoamerica', 'state' => 'bolivar', 'city' => 'guayana']);
        App\Concessionaire::create(['name' =>'toyotaimport', 'state' => 'bolivar', 'city' => 'san felix']);
        App\Concessionaire::create(['name' =>'toyocaracas', 'state' => 'caracas', 'city' => 'area metropolitana']);
        App\Concessionaire::create(['name' =>'toyovenezuela', 'state' => 'anzuategui', 'city' => 'barcelona']);
    }
}
