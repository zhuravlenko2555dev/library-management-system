<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        $user_count_in_group = [];
        $avg_user_in_group = 12;
        $group_count = 191;

        $change = 0;
        for ($i = 0; $i < $group_count; $i++) {
            if ($i % 2 == 0) {
                $change = $faker->numberBetween(0, 5);
                $val = $avg_user_in_group - $change;
            } else {
                $val = $avg_user_in_group + $change;
            }

            array_push($user_count_in_group, $val);
        }

        shuffle($user_count_in_group);

        $current_user_id = 1;
        for ($y = 0; $y < $group_count; $y++) {
            for ($z = 0; $z < $user_count_in_group[$y]; $z++) {
                $val = [
                    'user_id' => $current_user_id,
                    'group_id' => ($y + 1)
                ];
                $current_user_id++;

                array_push($data, $val);
            }
        }

        DB::table('user_groups')->insert($data);
    }
}
