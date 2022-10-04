<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class SisterConcernSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'concernName' => 'Daffodil International Academy (DIA)',
                'emailDomain' => 'daffodil.ac',
                'name' => 'Mr. Mohammad Nuruzzaman',
                'designation' => 'Executive Director',
                'concernAuthorityEmail' => 'ed@daffodil.ac',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'concernName' => 'Daffodil Computers Ltd. (DCL)',
                'emailDomain' => 'daffodil-bd.com',
                'name' => 'Mr. Jafar Ahmed Patwary',
                'designation' => 'Deputy General Manager',
                'concernAuthorityEmail' => 'dpc@daffodil-bd.com',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'concernName' => 'Daffodil Software Ltd. (DSL)',
                'emailDomain' => 'daffodil.com.bd',
                'name' => 'Mr. Rashed Karim',
                'designation' => 'Head of Software',
                'concernAuthorityEmail' => 'software@daffodil.com.bd',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'concernName' => 'Daffodil International Professional Training Institute (DIPTI)',
                'emailDomain' => 'dipti.com.bd',
                'name' => 'Mr. Rathindra Nath Das',
                'designation' => 'Executive Director',
                'concernAuthorityEmail' => 'ed@dipti.com.bd',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'concernName' => 'Daffodil Institute of IT (DIIT)',
                'emailDomain' => 'diit.info',
                'name' => 'Mohammed Shakhawat Hossain',
                'designation' => 'Principal (In-Charge)',
                'concernAuthorityEmail' => 'nup.principal@diit.info',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('sister_concerns')->insert($items);
    }
}
