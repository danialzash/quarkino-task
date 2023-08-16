<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(100)->create();

        // uncomment this line to seed products table with products.csv in database/data directory
        $this->seedFromCsvFile();
    }

    /**
     * This function read products from csv file in database/data/products.csv
     * @return void
     */
    private function seedFromCsvFile(): void
    {
        $productsCsvFile = fopen(database_path("data/products.csv"), "r");
        $firstLine = true;
        while (($data = fgetcsv($productsCsvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                $this->validateCsvRow($data) && Product::create([
                    "name" => $data['0'],
                    "brand" => $data['1'],
                    "available_quantity" => $data['2'],
                    "cost" => $data['3'],
                ]);
            }
            $firstLine = false;
        }
        fclose($productsCsvFile);
    }

    /**
     * This function validate rows parameter for require columns of products
     * @param bool|array $data
     * @return bool
     */
    private function validateCsvRow(bool|array $data): bool
    {
        return $data && $data['0'] && $data['2'] && $data['3'];
    }
}
