<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Affiliation::factory(5)->create();
        \App\Models\Person::factory(10)->create();
        \App\Models\Customer::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Quotation::factory(5)->has(\App\Models\QuotationItem::factory()->count(3), 'quotationItems')->create();
    }
}
