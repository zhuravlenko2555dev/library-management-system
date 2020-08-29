<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_id' => '1',
                'role_id' => '1',
            ],

            [
                'user_id' => '2',
                'role_id' => '2',
            ],
            [
                'user_id' => '3',
                'role_id' => '2',
            ],
            [
                'user_id' => '4',
                'role_id' => '2',
            ],
            [
                'user_id' => '5',
                'role_id' => '2',
            ],
            [
                'user_id' => '6',
                'role_id' => '2',
            ]
        ];

        $user_count = 191 * 12 + 100;
        for ($i = 7; $i <= (7 + $user_count - 1); $i++) {
            $user_role = [
                'user_id' => $i,
                'role_id' => '3',
            ];

            array_push($data, $user_role);
        }

        DB::table('user_roles')->insert($data);
    }
}
