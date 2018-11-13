<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'username' => 'tianqiyang',
                'email' => 'tianqiyang@qq.com',
                'cellphone' => '18482332878',
                'password' => bcrypt('tqyadmon'),
            ],
        ];

        foreach ($data as $sd) {
            $user = new Admin();
            $user->username = $sd['username'];
            $user->email = $sd['email'];
            $user->cellphone = $sd['cellphone'];
            $user->password = $sd['password'];
            $user->save();
        }
    }
}
