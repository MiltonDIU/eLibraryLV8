<?php
namespace Database\Seeders;


use App\Models\Author;
use App\Models\Category;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemStandardNumber;
use App\Models\Publisher;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use DB;
class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $publishers = Publisher::all()->pluck('id')->toArray();
        $categories = Category::all()->pluck('id')->toArray();
        $authors = Author::all()->pluck('id')->toArray();
        $departments = Department::all()->pluck('id')->toArray();
        $itemStandardNumber = ItemStandardNumber::all()->pluck('id')->toArray();
        for ($i = 1; $i < 100; $i++) {
            $item = [
                'publisher_id' => $faker->randomElement($publishers),
                'category_id' => $faker->randomElement($categories),
                'item_standard_number_id' => $faker->randomElement($itemStandardNumber),
                'title' => $faker->text(50),
                'slug' => $faker->slug(5),
                'edition' => $faker->randomElement(['1st', '2nd', '3rd', '4th']),
                'itemStandardNumberValue' => $faker->randomElement([20118, 20107, 20115, 24016, 20014, 20013, 24012, 23011]),
                'publicationYear' => $faker->randomElement([2018, 2017, 2015, 2016, 2014, 2013, 2012, 2011]),
                'placeOfPublication' => $faker->randomElement(['Dhaka', 'New York', 'Sydney', 'Wallington']),
                'keywords' => $faker->randomElement(['E-books', 'New book', 'funny', 'education', 'CSE', 'SWE', 'BBA', 'English', 'Law']),
                'uploadImageUrl' => $faker->randomElement(['book1.jpg', 'book2.jpg', 'book3.jpg', 'book4.PNG']),
                //'uploadImageUrl' => $faker->image('public/uploads/item/covers',201,266),
                'pdfUrl' => $faker->randomElement(['1504432.pdf', '1784708.pdf', '1857374.xlsx', '9344191.mp4', '5374071.docx']),
                'summary' => $faker->paragraph(6),
                'user_id' => 1,
                'isPublished' => $faker->randomElement([0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];


            //DB::table('items')->insert($item);
            $item = Item::create($item);
            $author['author_id'] = $faker->randomElement($authors);
            $department['department_id'] = $faker->randomElement($departments);
            $item->author()->attach($author);
            $item->department()->attach($department);
        }
    }
}
