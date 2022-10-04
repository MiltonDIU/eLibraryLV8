<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publishers = [
            [
                'publisherName' => 'Ventuno Press',
                'publisherPhone' => null,
                'publisherEmail' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'publisherName' => 'Springer',
                'publisherPhone' => null,
                'publisherEmail' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'publisherName' => 'Hafiz Book Centre',
                'publisherPhone' => null,
                'publisherEmail' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'publisherName' => 'CRC Press',
                'publisherPhone' => null,
                'publisherEmail' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]

        ];
        DB::table('publishers')->insert($publishers);
    }
}
