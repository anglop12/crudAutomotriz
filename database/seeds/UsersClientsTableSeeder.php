<?php

use App\Concessionaire;
use App\User;
use Illuminate\Database\Seeder;

class UsersClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        App\User::create([
            'email' => ('admin@admin.com'),
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
        ]);

        $names = ['angel', 'alfonso', 'jhonny', 'eduardo', 'gerardo', 'jesus'];
        $lastnames = ['ricardo', 'alfonso', 'jose', 'antonio', 'rafael', 'silvano'];

        $concessionaires = App\Concessionaire::all();
        $j = 0;
        foreach ($concessionaires as $item) {
            for ($i=0; $i < 4; $i++) { 
                $user = new User([
                    'email' => ('prueba.' . $i . '.' . $j++ . '@prueba.com'),
                    'email_verified_at' => now(),
                    'password' => bcrypt('0123456789'),
                ]);

                $user->save();

                App\Client::create([
                    'name' => $names[rand(0,5)],
                    'lastname' => $lastnames[rand(0,5)],
                    'age' => rand(18,45),
                    'concessionaire_id' => $item->id,
                ]);
            }
        }
    }
}
