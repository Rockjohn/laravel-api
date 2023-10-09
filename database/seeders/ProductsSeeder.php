<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        Product::truncate();

        Product::create([
            'name' => 'Beef Liver Capsules',
            'description' => 'Freeze-dried beef liver capsules rich in vitamins and minerals.',
            'price' => 29.99
        ]);
        
        Product::create([
            'name' => 'Collagen Peptides',
            'description' => 'Sourced from grass-fed bovine to support hair, skin, and nails.',
            'price' => 39.99
        ]);
        
        Product::create([
            'name' => 'Bone Broth Protein Powder',
            'description' => 'Protein powder sourced from simmered beef bones, packed with amino acids.',
            'price' => 49.99
        ]);
        
        Product::create([
            'name' => 'Fish Oil Capsules',
            'description' => 'Rich in Omega-3 fatty acids derived from fish, supports heart health.',
            'price' => 19.99
        ]);
    }
}
