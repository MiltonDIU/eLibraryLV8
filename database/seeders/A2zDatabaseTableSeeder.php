<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\A2zType;
use App\Models\A2zVendor;
use App\User;
use App\Models\A2zDatabase;
use App\Models\A2ZSubject;
use DB;
class A2zDatabaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $a2zType = A2zType::all()->pluck('id')->toArray();
        $a2zVendor = A2zVendor::all()->pluck('id')->toArray();
        $subjects = A2ZSubject::all()->pluck('id')->toArray();
        for ($i = 1; $i < 50; $i++) {
            $a2zDatabases = [
                'a2z_type_id' => $faker->randomElement($a2zType),
                'a2z_vendor_id' => $faker->randomElement($a2zVendor),
                'user_id' => $faker->randomElement([1,2]),
                'a2zTitle' => $faker->text(50),
                'a2zDescription' => $faker->paragraph(5),
                'trial' => $faker->randomElement([1,0,1,1,0,1,1,1]),
                'lock' => $faker->randomElement([1,0,1,1,0,1,1,1]),
                'redirectLink' => $faker->url,
                'isVisible' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            $a2zDatabase = A2zDatabase::create($a2zDatabases);

            for ($j = 1; $j < 3; $j++) {
                $subject = $faker->randomElement($subjects);
                $a2zDatabase->a2zSubject()->attach($subject);

            }



        }
    }
}
