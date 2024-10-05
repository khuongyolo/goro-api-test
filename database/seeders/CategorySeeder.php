<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $categories = [
            ['name' => 'Tất cả', 'icon' => 'fa-solid fa-store', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Thịt', 'icon' => 'fa-solid fa-bacon', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Mì gói', 'icon' => 'fa-solid fa-bowl-food', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Bánh mặn', 'icon' => 'fa-solid fa-hotdog', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Bánh ngọt', 'icon' => 'fa-solid fa-cake-candles', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Nước giải khát', 'icon' => 'fa-solid fa-bottle-water', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Rau củ', 'icon' => 'fa-solid fa-carrot', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Trái cây', 'icon' => 'fa-solid fa-lemon', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Đồ ăn vặt', 'icon' => 'fa-solid fa-stroopwafel', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Đồ tươi', 'icon' => 'fa-solid fa-egg', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Đồ đông lạnh', 'icon' => 'fa-solid fa-snowflake', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Gia vị', 'icon' => 'fa-solid fa-pepper-hot', 'created_at' => $now, 'create_user' => 'GORO'],
            ['name' => 'Đặc biệt', 'icon' => 'fa-solid fa-star', 'created_at' => $now, 'create_user' => 'GORO'],
        ];

        DB::table('categories')->insert($categories);
    }
}
