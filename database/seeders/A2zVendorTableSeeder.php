<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;
class A2zVendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = [
            [
                'a2zVendorName' => 'Sage Publication',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'a2zVendorName' => 'Academic Journals',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'a2zVendorName' => 'American Chemical Society',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'a2zVendorName' => 'EBSCO Host',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('a2z_vendors')->insert($item);


    }
}
