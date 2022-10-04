<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = [
            [
                'id' => '-2',
                'ratingName' => 'Angry',
                'image' => 'angry.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => '-1',
                'ratingName' => 'Sad',
                'image' => 'sad.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => '1',
                'ratingName' => 'Like',
                'image' => 'like.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => '3',
                'ratingName' => 'love',
                'image' => 'love.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => '5',
                'ratingName' => 'Wow',
                'image' => 'wow.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ];
        DB::table('ratings')->insert($ratings);
    }
}
