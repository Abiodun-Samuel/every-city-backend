<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        // Contact forms
        Form::factory()->count(10)->contact()->create();

        // Prayer forms
        Form::factory()->count(15)->prayer()->create();

        // BHOP Application forms
        Form::factory()->count(8)->bhopApplication()->create();

        // Mail list forms
        Form::factory()->count(20)->mailList()->create();
    }
}
