<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'authorName' => 'Jane K. Setlow',
                'slug' => 'Jane',
                'email' => 'Setlow@yahoo.com',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'authorName' => 'Giusuddin Ahmed',
                'slug' => 'Giusuddin',
                'email' => '',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'authorName' => 'Dean G. Duffy',
                'slug' => 'Dean',
                'email' => 'duffy@gmail.com',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]

        ];
        DB::table('authors')->insert($authors);
    }
}
