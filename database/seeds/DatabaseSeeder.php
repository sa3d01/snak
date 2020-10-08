<?php

use Illuminate\Database\Seeder;
use App\DropDown;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UserTypeSeeder::class,
             AdminSeeder::class,
         ]);
         //school types
        DropDown::create([
            'class' => 'SchoolType',
            'name->ar' => 'حضانة'
        ]);
        DropDown::create([
            'class' => 'SchoolType',
            'name->ar' => 'مدرسة'
        ]);
        //grades
        DropDown::create([
            'class' => 'SchoolGrade',
            'name->ar' => 'أقل من 3 سنوات',
            'parent_id'=>1
        ]);
        DropDown::create([
            'class' => 'SchoolGrade',
            'name->ar' => 'أكثر من 3 سنوات',
            'parent_id'=>1
        ]);
        DropDown::create([
            'class' => 'SchoolGrade',
            'name->ar' => 'الصف الأول الابتدائي',
            'parent_id'=>2
        ]);
        DropDown::create([
            'class' => 'SchoolGrade',
            'name->ar' => 'الصف الأول الاعدادى',
            'parent_id'=>2
        ]);
        DropDown::create([
            'class' => 'SchoolGrade',
            'name->ar' => 'الصف الأول الثانوى',
            'parent_id'=>2
        ]);
        //schools
        DropDown::create([
            'class' => 'School',
            'name->ar' => 'مدرسة أحمد بن طولون',
            'parent_id'=>2
        ]);
        DropDown::create([
            'class' => 'School',
            'name->ar' => 'مدرسة الثورة',
            'parent_id'=>2
        ]);
        //break time
        DropDown::create([
            'class' => 'Break',
            'name->ar' => '12:00 AM',
        ]);
        DropDown::create([
            'class' => 'Break',
            'name->ar' => '02:00 PM',
        ]);
        DropDown::create([
            'class' => 'Break',
            'name->ar' => '04:00 PM',
        ]);
//        //packages
        \App\Package::create([
            'name->ar' => 'snakYard mail',
            'note->ar' => '✓ 2 Sandwich, ✓ 2 Sandwich, ✓ 2 Sandwich, ✓ 2 Sandwich, ✓ 2 Sandwich,  ',
            'price'=>10,
            'color'=>'EA3B44',
            'images'=>['default.png','bg5J6Q7DVl.jpg']
        ]);
        \App\PromoCode::create([
            'percent' => 20,
            'code' => 'snack-2021',
            'count'=>10,
            'used'=>0,
        ]);
        //settings
        \App\Setting::create([
            'about->ar' => 'عن التطبيق',
            'licence->ar' => 'الشروط والأحكام',
        ]);



    }
}
