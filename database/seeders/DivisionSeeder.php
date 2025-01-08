<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;
use Illuminate\Support\Str;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create(['id' => Str::uuid(), 'name' => 'Mobile Apps']);
        Division::create(['id' => Str::uuid(), 'name' => 'QA']);
        Division::create(['id' => Str::uuid(), 'name' => 'Full Stack']);
        Division::create(['id' => Str::uuid(), 'name' => 'Backend']);
        Division::create(['id' => Str::uuid(), 'name' => 'Frontend']);
        Division::create(['id' => Str::uuid(), 'name' => 'UI/UX Designer']);
        Division::create(['id' => Str::uuid(), 'name' => 'Project Manager']);
        Division::create(['id' => Str::uuid(), 'name' => 'Scrum Master']);
        Division::create(['id' => Str::uuid(), 'name' => 'IT Support']);
        Division::create(['id' => Str::uuid(), 'name' => 'HRD']);
        Division::create(['id' => Str::uuid(), 'name' => 'Wordpress Developer']);
        Division::create(['id' => Str::uuid(), 'name' => 'Copywriter']);
        Division::create(['id' => Str::uuid(), 'name' => 'Graphic Designer']);
    }
}
