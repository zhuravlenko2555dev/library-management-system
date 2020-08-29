<?php

use Faker\Provider\ru_RU\Person as RuPerson;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $faker->addProvider(new RuPerson($faker));

        $data = [
            // admin
            [
                'id' => 1,
                'login' => 'admin',
                'password' => bcrypt('admin1234567890'),
                'email' => 'admin@email.com',
                'name' => $faker->firstNameMale,
                'surname' => $faker->lastName(RuPerson::GENDER_MALE),
                'middle_name' => $faker->middleNameMale,
                'birthdate' => $faker->dateTimeBetween('-35 years', '-30 years'),
                'gender' => 'm',
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,

                'email_verified_at' => DB::raw('now()')
            ],
        ];

        // librarian
        for ($i = 2; $i <= 6; $i++) {
            $user = [
                'id' => $i,
                'login' => 'librarian_' . $i,
                'password' => bcrypt('librarian12345'),
                'email' => 'librarian_' . $i .'@email.com',
                'name' => $faker->firstNameFemale,
                'surname' => $faker->lastName(RuPerson::GENDER_FEMALE),
                'middle_name' => $faker->middleNameFemale,
                'birthdate' => $faker->dateTimeBetween('-45 years', '-30 years'),
                'gender' => 'f',
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,

                'email_verified_at' => DB::raw('now()')
            ];
            array_push($data, $user);
        }

        // user
        $user_count = 191 * 12 + 100;
        for ($i = 7; $i <= (7 + $user_count - 1); $i++) {
            $user = [
                'id' => $i,
                'login' => 'reader_' . $i,
                'password' => bcrypt('reader12345'),
                'email' => 'reader_' . $i .'@email.com',
                'birthdate' => $faker->dateTimeBetween('-40 years', '-11 years'),
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,
            ];

            if ($faker->boolean) {
                $user['name'] = $faker->firstNameMale;
                $user['surname'] = $faker->lastName(RuPerson::GENDER_MALE);
                $user['middle_name'] = $faker->middleNameMale;
                $user['gender'] = 'm';
            } else {
                $user['name'] = $faker->firstNameFemale;
                $user['surname'] = $faker->lastName(RuPerson::GENDER_FEMALE);
                $user['middle_name'] = $faker->middleNameFemale;
                $user['gender'] = 'f';
            }

            if ($faker->boolean) {
                $user['email_verified_at'] = DB::raw('now()');
            } else {
                $user['email_verified_at'] = DB::raw('NULL');
            }

            array_push($data, $user);
        }

        DB::table('users')->insert($data);
    }
}
