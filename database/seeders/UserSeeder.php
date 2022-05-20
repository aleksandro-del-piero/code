<?php

namespace Database\Seeders;

use App\Models\Position;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->generateUsers());
    }

    /**
     * @return int
     */
    public function getCountUsers() : int
    {
        return config('users.seeder_count_users');
    }

    /**
     * @return array
     */
    public function generateUsers() : array
    {
        /** @var Generator $faker */
        $faker = app(Generator::class);

        $positions = Position::get();

        $users = [];

        for ($i=1; $i <= $this->getCountUsers(); $i++){
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'position_id' => $positions->random()->id,
                'password' => Hash::make(Str::random(8)),
                'photo' => 'user-photo/avatar.png',
                'created_at' => now()
            ];
        }

        return $users;
    }

}
