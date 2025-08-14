<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $links  = DB::table('links')->pluck('id');

        foreach ($links as $linkId) {
            $visitCount = $faker->numberBetween(1, 20);
            for ($i = 0; $i < $visitCount; $i++) {
                DB::table('visits')->insert([
                    'link_id'    => $linkId,
                    'ip_hash' => $faker->ipv4,
                    'user_agent' => $faker->userAgent,
                    'created_at' => Carbon::now()->subDays($faker->numberBetween(0, 30)),

                ]);
            }
        }
    }
}
