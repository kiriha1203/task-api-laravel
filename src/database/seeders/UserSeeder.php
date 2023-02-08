<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 中身の削除
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // データ挿入
        DB::table('users')->insert([
            [
                'id' => 1,
                "name" => 'test user1',
                'email' => 'test_user@example.com',
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 2,
                "name" => 'test user2',
                'email' => 'test_user2@example.com',
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 3,
                "name" => 'test user3',
                'email' => 'test_user3@example.com',
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 4,
                "name" => 'test user4',
                'email' => 'test_user4@example.com',
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 5,
                "name" => 'test user5',
                'email' => 'test_user5@example.com',
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ]
        ]);
    }
}
