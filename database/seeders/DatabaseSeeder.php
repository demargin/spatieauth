<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Student_Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::table('users')->truncate();

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@admin.com',
             'password' => 'password',
         ]);

         \DB::table('students')->truncate();

         $faker = Factory::create();

         for ($i = 0; $i < 100; $i++) {
             $student = new Student_Model();
             $student->name = $faker->name();
             $student->course = $faker->name();
             $student->email = $faker->safeEmail();
             $student->phone = $faker->phoneNumber();
             $student->save();
        }
    }
}