<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HolidayPackages;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class HolidayPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $units = ['hari', 'paket', 'tiket'];
        $categories = Category::all();

        for ($i = 0; $i < 5; $i++) {
            $holidayPackage = HolidayPackages::create([
                'name' => $faker->sentence(3), 
                'category_id' => $categories->random()->id, 
                'price' => $faker->randomFloat(2, 100, 1000),
                'desc' => $faker->paragraph,
                'image' => $this->generateImage(), 
                'unit' => $units[array_rand($units)], 
            ]);
        }
    }

    private function generateImage(): string
    {
        $imageUrl = 'https://picsum.photos/400/300';
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'holiday_' . uniqid() . '.jpg';

        Storage::put('public/' . $imageName, $imageContents);

        return $imageName;
    }
}
