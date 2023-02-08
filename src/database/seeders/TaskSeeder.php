<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テーブルの中身を削除
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // テーブルにデータを挿入
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'title' => 'PHP言語に慣れる',
                'context' => 'AtCoder Beginners Selection',
                'status' => 'waiting',
                'create_user_id' => '1',
                'created_at' => '2023-02-11 12:11:11',
                'updated_at' => '2023-02-13 14:22:33'
            ],
            [
                'id' => 2,
                'title' => 'Laravelに慣れる',
                'context' => '実装を行う',
                'status' => 'working',
                'create_user_id' => '2',
                'created_at' => '2023-02-11 12:11:11',
                'updated_at' => '2023-02-13 14:22:33'
            ],
            [
                'id' => 3,
                'title' => 'LravelTask1',
                'context' => 'MVCモデルでの実装',
                'status' => 'completed',
                'create_user_id' => '3',
                'created_at' => '2023-02-11 12:11:11',
                'updated_at' => '2023-02-13 14:22:33'
            ],
            [
                'id' => 4,
                'title' => 'LaravelTask2',
                'context' => 'ADRモデルでの実装',
                'status' => 'waiting',
                'create_user_id' => '4',
                'created_at' => '2023-02-11 12:11:11',
                'updated_at' => '2023-02-13 14:22:33'
            ],
            [
                'id' => 5,
                'title' => 'ベースの理解を深める',
                'context' => '技術書を読む',
                'status' => 'working',
                'create_user_id' => '5',
                'created_at' => '2023-02-11 12:11:11',
                'updated_at' => '2023-02-13 14:22:33'
            ]
        ]);
    }
}
