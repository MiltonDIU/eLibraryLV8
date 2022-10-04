<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Service;
use DB;
class RoleServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Service::all()->count();
        for ($i = 1; $i <= $count; $i++) {
            $roleService = [
                'role_id' => 1,
                'service_id' => $i,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            DB::table('role_service')->insert($roleService);
        }

        //individual service add
        /*
         $roleService = [
             'role_id' => 1,
             'service_id' => 2,
             'created_at' => Carbon::now()->toDateTimeString(),
             'updated_at' => Carbon::now()->toDateTimeString(),
         ];
         DB::table('role_service')->insert($roleService);
        */
    }
}
