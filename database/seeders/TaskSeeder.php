<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Task;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Task::truncate();

        $statusIds = Status::pluck('id')->toArray();

        $tasks = [];
        $faker = Factory::create();

        for ($i = 1; $i <= 50; $i++) {
            $tasks[] = [
                'title' => $faker->sentence,
                'status_id' => $faker->randomElement($statusIds),
            ];
        }

        Task::insert($tasks);
    }
}
