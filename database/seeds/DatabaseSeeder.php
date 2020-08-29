<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(FromSQLSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(UserRoleSeeder::class);
         $this->call(FacultySeeder::class);
         $this->call(GroupSeeder::class);
         $this->call(UserGroupSeeder::class);
         $this->call(BookItemAndShelfSeeder::class);
         $this->call(BorrowedAndReservedBookSeeder::class);
    }
}
