<?php

use Illuminate\Database\Seeder;
use App\Note;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Note::create([
                'title' => $faker->text(20),
                'text' => $faker->text(60)
            ]);
        }
    }
}
