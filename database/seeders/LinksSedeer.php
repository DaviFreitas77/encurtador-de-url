<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;


class LinksSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userId = DB::table('users')->where('email', 'teste@example.com')->value('id');

        for ($i = 0; $i < 5000; $i++) {
            $isActive = $faker->boolean(60);
            DB::table('links')->insert([
                'user_id' => $userId,
                'original_url' => $faker->url,
                'slug' => $faker->unique()->lexify('??????'),
                'click_count'  => $faker->numberBetween(0, 1000),
                'status' => $isActive ? 'active' : 'expired',
                'expires_at' => $isActive
                    ? Carbon::now()->addDays($faker->numberBetween(1, 30))
                    : Carbon::now()->subDays($faker->numberBetween(1, 30)),
                'created_at' => now(),
                'updated_at' => now()

            ]);
        }
    }
}
