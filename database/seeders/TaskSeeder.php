<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //khởi tạo đối tượng faker = Mockaroo
        $faker = Faker::create('vi');

        foreach (range(1, 10) as $index) {
            Task::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'long_description' => $faker->optional()->text(),
                'completed' => $faker->boolean(),
            ]);
        }

    }
}
