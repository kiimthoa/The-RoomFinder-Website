<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([
        	['name'=>'Bến Thủy','slug'=>'ben-thuy'],
        	['name'=>'Trung Đô','slug'=>'trungh-do'],
        	['name'=>'Trường Thi','slug'=>'truong-thi'],
        	['name'=>'Quang Trung','slug'=>'quang-trung'],
        	['name'=>'Phượng Hoàng','slug'=>'phuong-hoang'],
        	['name'=>'Đội Cung','slug'=>'doi-cung']
        ]);
        $this->call(CategoriesSeeder::class);
    }
}
/**
* 
*/
class CategoriesSeeder extends Seeder
{
    public function run(){
        DB::table('categories')->insert([
            ['name'=>'Phòng trọ cho thuê','slug'=>'phong-tro-cho-thue'],
            ['name'=>'Ở ghép','slug'=>'o-ghep'],
            ['name'=>'Nhà cấp 4','slug'=>'nha-nguyen-can'],
            ['name'=>'Chung cư mini','slug'=>'chung-cu']
        ]);
    }
}
