<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'itemCategory' => 'Ebooks',
                'image' => '',
                'itemCategoryShort' => 'ebooks',
                'shortDescription' => 'We provide these ebooks for our registered users.  Some of these ebooks we have purchased and some we have collected for our well wishers for our users. In this module you will get all these books which are helpful for your departmental study. ',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Articles',
                'image' => '',
                'itemCategoryShort' => 'articles',
                'shortDescription' => 'Our users get renowned publishers journal articles through this module.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Voice Library',
                'image' => '',
                'itemCategoryShort' => 'voice-library',
                'shortDescription' => 'We are pioneer in this field in Bangladesh. We prepare these audio books for our user s to save their time. ',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'e-books by UDL',
                'image' => '',
                'itemCategoryShort' => 'e-books-by-udl',
                'shortDescription' => 'These books have purchased from the University Grants Commission (UGC) of Bangladesh.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'A-Z Databases',
                'image' => '',
                'itemCategoryShort' => 'a2z-databases',
                'shortDescription' => 'We arrange all our purchased databases for our users according to ascending system. ',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => 'http://localhost:8000/a2z-databases',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Higher Education',
                'image' => '',
                'itemCategoryShort' => 'higher-education',
                'shortDescription' => 'The HEDBIB database is a unique resource of references and publications on higher education systems, administration, planning, policy and evaluation from around the world.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Project Reports',
                'image' => '',
                'itemCategoryShort' => 'project-reports',
                'shortDescription' => 'We preserve our student’s project reports in this site. You can download these resources for your research and further study purpose.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Web Resources',
                'image' => '',
                'itemCategoryShort' => 'web-resources',
                'shortDescription' => 'Web resources are the short navigation of online resources related to the department\'s particular subject.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'DIU Publications',
                'image' => '',
                'itemCategoryShort' => 'diu-publications',
                'shortDescription' => 'Total four (04) Journals published by DIU named DIU Journal of Allied Health Sciences, DIU Journal of Business and Economics, DIU Journal of Humanities & Social Science, and DIU Journal of Science and Technology are preserved for research purpose and further study.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'DIU Newsletters',
                'image' => '',
                'itemCategoryShort' => 'diu-newsletters',
                'shortDescription' => 'DIU publishes newsletter regularly to inform its activities to others.  ',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => 'http://newsletter.daffodilvarsity.edu.bd/',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'CAS',
                'image' => '',
                'itemCategoryShort' => 'cas',
                'shortDescription' => 'Current Awareness Services (CAS) is some selected articles’ abstracts of latest arrived journals published by different organizations and universities of Bangladesh.',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'itemCategory' => 'Magazines',
                'image' => '',
                'itemCategoryShort' => 'magazines',
                'shortDescription' => 'e-Magazines are the leading source of latest products and other updates related to DIU curriculums',
                'accessibilityWithoutAuthentication' => '0',
                'externalUrl' => '',
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
