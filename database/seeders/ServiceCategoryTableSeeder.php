<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class ServiceCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceCategory = [
            [
                'serviceCategory' => 'Dashboard',//1
                'image' => null,
                'serviceCategoryShort' => 'dashboard',
                'accessibilityWithoutAuthentication' =>0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Roles',//2
                'image' => null,
                'serviceCategoryShort' => 'roles',
                'accessibilityWithoutAuthentication' =>0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Users',//3
                'image' => null,
                'serviceCategoryShort' => 'users',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Departments',//4
                'image' => null,
                'serviceCategoryShort' => 'department',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Authors',//5
                'image' => null,
                'serviceCategoryShort' => 'author',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Publishers',//6
                'image' => null,
                'serviceCategoryShort' => 'publisher',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Service Categories',//7
                'image' => null,
                'serviceCategoryShort' => 'service-category',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Item Standard Number',//8
                'image' => null,
                'serviceCategoryShort' => 'item-standard-number',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Items',//9
                'image' => null,
                'serviceCategoryShort' => 'item',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Sister Concern',//10
                'image' => null,
                'serviceCategoryShort' => 'sister-concern',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Ratings',//11
                'image' => null,
                'serviceCategoryShort' => 'rating',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'A2Z Database Types',//12
                'image' => null,
                'serviceCategoryShort' => 'a2z-type',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'A2Z Database Vendors',//13
                'image' => null,
                'serviceCategoryShort' => 'a2z-vendor',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'A2Z Database Subject',//14
                'image' => null,
                'serviceCategoryShort' => 'a2z-subject',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'A2Z Database',//15
                'image' => null,
                'serviceCategoryShort' => 'a2z-database',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Issue Tracking',//16
                'image' => null,
                'serviceCategoryShort' => 'issue-tracking',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
           [
                'serviceCategory' => 'Audit Logs',//17
                'image' => null,
                'serviceCategoryShort' => 'audit-logs',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
           [
                'serviceCategory' => 'Item Category',//18
                'image' => null,
                'serviceCategoryShort' => 'item-category',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
           [
                'serviceCategory' => 'Report',//19
                'image' => null,
                'serviceCategoryShort' => 'report',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],

            [
                'serviceCategory' => 'Semester',//20
                'image' => null,
                'serviceCategoryShort' => 'semester',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'serviceCategory' => 'Supervisor',//21
                'image' => null,
                'serviceCategoryShort' => 'supervisor',
                'accessibilityWithoutAuthentication' => 0,
                'externalUrl' => null,
                'isVisible' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]

        ];
        DB::table('service_categories')->insert($serviceCategory);
    }
}
