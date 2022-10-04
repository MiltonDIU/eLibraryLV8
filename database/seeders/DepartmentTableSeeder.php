<?php
namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;
class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'departmentName' => 'Business Administration',
                'deptShortName' => 'BBA',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Commerce',
                'deptShortName' => 'Commerce',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Real Estate',
                'deptShortName' => 'BRE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Tourism & Hospitality Management',
                'deptShortName' => 'THM',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Entrepreneurship',
                'deptShortName' => 'DE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Computer Science and Engineering',
                'deptShortName' => 'CSE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Software Engineering',
                'deptShortName' => 'SWE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Multimedia & Creative Technology',
                'deptShortName' => 'MCT',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'General Educational Development',
                'deptShortName' => 'GED',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Environmental Science and Disaster Management',
                'deptShortName' => 'ESDM',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Computing and Information System',
                'deptShortName' => 'CIS',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Electronics and Telecommunication Engineering',
                'deptShortName' => 'ETE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Textile Engineering',
                'deptShortName' => 'TE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Electrical and Electronic Engineering',
                'deptShortName' => 'EEE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Architecture',
                'deptShortName' => 'Architecture',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Civil Engineering',
                'deptShortName' => 'CE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Pharmacy',
                'deptShortName' => 'Pharmacy',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Nutrition and Food Engineering',
                'deptShortName' => 'NFE',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Public Health',
                'deptShortName' => 'PH',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'English',
                'deptShortName' => 'English',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Law',
                'deptShortName' => 'Law',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Journalism & Mass Communication',
                'deptShortName' => 'JMC',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'departmentName' => 'Development Studies',
                'deptShortName' => 'DS',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ];
        DB::table('departments')->insert($departments);
    }
}
