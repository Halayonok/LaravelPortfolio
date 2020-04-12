<?php

use Illuminate\Database\Seeder;

class BaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addUsers();
    }

    public function addUsers()
    {
        if (!DB::table('users')->count()) {
            DB::table('users')->insert([
                [
                    'name' => 'Ivan L.',
                    'email' => 'ivan_l@woope.dev',
                    'email_verified_at' => \Carbon\Carbon::now(),
                    'password' => Hash::make('qaz_wsx_edc'),
                    'role' => \App\Users::ROLE_ROOT,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'Alex H.',
                    'email' => 'alex_h@woope.dev',
                    'email_verified_at' => \Carbon\Carbon::now(),
                    'password' => Hash::make('qaz_wsx_edc'),
                    'role' => \App\Users::ROLE_ADMIN,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'Alex B.',
                    'email' => 'alex_b@woope.dev',
                    'email_verified_at' => \Carbon\Carbon::now(),
                    'password' => Hash::make('qaz_wsx_edc'),
                    'role' => \App\Users::ROLE_ADMIN,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]
            ]);
        }

        if (!DB::table('languages')->count()) {
            DB::table('languages')->insert([
                [
                    'code' => 'by',
                    'main' => \App\Languages::MAIN,
                    'enable' => \App\Languages::$enableFlag,
                ],
                [
                    'code' => 'en',
                    'main' => \App\Languages::NOT_MAIN,
                    'enable' => \App\Languages::$enableFlag,
                ],
                [
                    'code' => 'ru',
                    'main' => \App\Languages::NOT_MAIN,
                    'enable' => \App\Languages::$enableFlag,
                ],
            ]);
        }
    }
}
