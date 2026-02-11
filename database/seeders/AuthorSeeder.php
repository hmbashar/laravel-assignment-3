<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'J.K. Rowling',
                'bio' => 'British author, best known for the Harry Potter fantasy series.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'George Orwell',
                'bio' => 'English novelist and essayist, journalist and critic.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Stephen King',
                'bio' => 'American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Agatha Christie',
                'bio' => 'English writer known for her 66 detective novels and 14 short story collections.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Isaac Asimov',
                'bio' => 'American writer and professor of biochemistry, known for his works of science fiction.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Malcolm Gladwell',
                'bio' => 'Canadian journalist, author, and public speaker.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yuval Noah Harari',
                'bio' => 'Israeli public intellectual, historian and professor.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dale Carnegie',
                'bio' => 'American writer and lecturer, developer of courses in self-improvement.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('authors')->insert($authors);
    }
}
