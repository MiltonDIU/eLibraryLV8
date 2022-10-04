<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class ItemStandardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item_standard_numbers = [
            [
                'itemStandardName' => 'International Standard Book Number',
                'sortName' => 'ISBN',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'International Standard Serial Number',
                'sortName' => 'ISSN',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'International Standard Recording Code',
                'sortName' => 'ISRC',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'Universal Product Code',
                'sortName' => 'UPC',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'International Standard Music Number',
                'sortName' => 'ISMN',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'International Article Number',
                'sortName' => 'EAN',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemStandardName' => 'Serial Item and Contribution Identifier',
                'sortName' => 'SICI',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]

        ];
        DB::table('item_standard_numbers')->insert($item_standard_numbers);
    }
}
