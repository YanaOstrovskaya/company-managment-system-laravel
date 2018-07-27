<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EmployeeProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 50) as $index)
        {
         $employeeProfileId = App\Models\EmployeeProfile::create([
                'birhdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'photo' => 'default-avatar.png',
                'job_start_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'phone' => $faker->phoneNumber,
                'job_title' => $faker->jobTitle
            ])->id;
         App\Models\User::create([
             'name' => $faker->name,
             'email' => $faker->unique()->safeEmail,
             'employee_profile_id' => $employeeProfileId,
             'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
             'remember_token' => str_random(10),
         ]);
        }
    }
}
