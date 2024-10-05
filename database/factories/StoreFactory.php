<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP');
        $id = Store::max('id') + 1;
        $user_ids = User::pluck('id')->toArray();
        if (empty($user_ids)) $user_ids = [1, 2, 3];
        return [
            'store_no' => 'STR' . str_pad($id, 7, '0', STR_PAD_LEFT),
            'name' => 'Store ' . strtoupper($this->faker->lexify('???')),
            'store_owner' => $user_ids[array_rand($user_ids)],
            'zip_code' => $faker->postcode,
            'address' => $faker->city,
            'tel' => $this->generatePhoneNumber(),
            'mail' => $faker->email,
            'facebook' => '',
            'instagram' => '',
            'tiktok' => '',
            'del_flg' => '0',
            'created_at' => now(),
            'create_user' => 'GORO',
        ];
    }

    private function generatePhoneNumber()
    {
        // Tạo một số điện thoại ngẫu nhiên có tối đa 11 số
        return $this->faker->numerify('###########'); // 11 số
    }
}
