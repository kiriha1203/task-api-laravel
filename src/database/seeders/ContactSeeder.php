<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 中身の削除
        DB::table('contacts')->truncate();

        // データ挿入
        DB::table('contacts')->insert([
            [
                'id' => 1,
                'task_id' => 1,
                'user_id' => 1,
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 2,
                'task_id' => 1,
                'user_id' => 2,
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 3,
                'task_id' => 2,
                'user_id' => 3,
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 4,
                'task_id' => 3,
                'user_id' => 1,
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ],
            [
                'id' => 5,
                'task_id' => 5,
                'user_id' => 5,
                'created_at' =>'2023-02-01 12:11:11',
                'updated_at' =>'2023-02-02 14:11:11'
            ]
        ]);
    }
}
