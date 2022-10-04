<?php
namespace Database\Seeders;

namespace Database\Seeders;

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



            $this->call(RolesTableSeeder::class);
            $this->call(SisterConcernSeeder::class);
            $this->call(ServiceCategoryTableSeeder::class);
            $this->call(ServiceTableSeeder::class);
            $this->call(RoleServiceTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(DepartmentTableSeeder::class);
            $this->call(AuthorTableSeeder::class);
            $this->call(PublisherTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
            $this->call(ItemStandardTableSeeder::class);
            $this->call(RatingTableSeeder::class);
            $this->call(ItemTableSeeder::class);
            $this->call(A2zTypeTableSeeder::class);
            $this->call(A2zVendorTableSeeder::class);
            $this->call(A2zDatabaseTableSeeder::class);


    }
}
