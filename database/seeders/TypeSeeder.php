<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::truncate();
        Type::insert(
            [
                [
                    'name' => 'Toán',
                    'image' => 'pages/Photo/toan.png',
                ],
                [
                    'name' => 'Tiếng Việt',
                    'image' => 'pages/Photo/vietanh.png',
                ],
                [
                    'name' => 'Tiếng Anh',
                    'image' => 'pages/Photo/vietanh.png',
                ],
                [
                    'name' => 'Tự Nhiên & Xã Hội',
                    'image' => 'pages/Photo/tunhien.png',
                ],
                [
                    'name' => 'Lịch Sử',
                    'image' => 'pages/Photo/lichsu.png',
                ],
                [
                    'name' => 'Địa Lý',
                    'image' => 'pages/Photo/dialy.png',
                ],
            ]
        );
    }
}
