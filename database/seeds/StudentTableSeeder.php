<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Student::class, 50)->create()->each(function($student) {
            $student->phone()->save(factory(App\Models\Phone::class)->make());
            $student->address()->save(factory(App\Models\Address::class)->make());
        });
    }
}
