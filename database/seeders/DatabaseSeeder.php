<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Access_detailSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(User_typeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AccessSeeder::class);
        $this->call(BrandsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubCategoriesSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(ContractSeeder::class);
    }
}
