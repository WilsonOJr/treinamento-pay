<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryModel = app(Category::class);

        $categoryModel->firstOrCreate(
            ['name' => 'Suspense']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Terror']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Romance']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Fantasia']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Aventura']
        );
    }
}
