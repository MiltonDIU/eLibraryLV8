<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Service::get()->count();

        $user = [
            [
                'email' => 'kibria.library@daffodilvarsity.edu.bd',
                'username' => 'kibria',
                'displayName' => 'Kibria',
                'verified' => 1,
                'status' => 1,
                'password' => Hash::make('123456'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'email' => 'milton2913@gmail.com',
                'username' => 'milton',
                'displayName' => 'Md.Milton',
                'verified' => 1,
                'status' => 1,
                'password' => Hash::make('123456'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('users')->insert($user);

        $roleUser = [
            [
                'role_id' => 1,
                'user_id' => 1,
                'login_id' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'role_id' => 1,
                'user_id' => 2,
                'login_id' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('role_user')->insert($roleUser);
        for ($j = 1; $j <= 2; $j++) {
            for ($i = 1; $i <= $count; $i++) {
                $serviceUser = [
                    'user_id' => $j,
                    'service_id' => $i,
                    'login_id' => null,
                    'isRoleService' => 1,
                    'roleCount' => 1,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                DB::table('service_user')->insert($serviceUser);
            }
        }

    }
}
