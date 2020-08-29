<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'id' => 1,
                'name' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'librarian',
            ],
            [
                'id' => 3,
                'name' => 'reader',
            ],
        ];
        DB::table('roles')->insert($data);
    }
}
