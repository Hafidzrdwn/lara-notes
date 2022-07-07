<?php

namespace Database\Seeders;

use App\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(4)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Workspace::factory(10)->create();

        // $spaces = array(
        //     [
        //         'user_id' => 1,
        //         'title' => 'My Struggles',
        //         'slug' => 'my-stuggles',
        //         'desc' => 'space for my daily struggle when i\'m bored',
        //         'is_example' => 1
        //     ],
        //     [
        //         'user_id' => 1,
        //         'title' => 'Pengeluaran Bulanan',
        //         'slug' => 'pengeluaran-bulanan',
        //         'desc' => 'untuk ngetrack pengeluaran pribadi dalam jangka 1 bulan',
        //         'is_example' => 1
        //     ],
        //     [
        //         'user_id' => 1,
        //         'title' => 'Daily Todo',
        //         'slug' => 'daily-todo',
        //         'desc' => 'my daily todolist.',
        //         'is_example' => 1
        //     ],
        // );

        // $categories = array(
        //     [
        //         'name' => 'Basic Note',
        //     ],
        //     [
        //         'name' => 'Basic List Note',
        //     ],
        //     [
        //         'name' => 'TodoList',
        //     ]
        // );

        $projects = array(
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'Programming',
                'slug' => 'programming',
                'security' => 0
            ],
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'testing',
                'slug' => 'testing',
                'security' => 1
            ],
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'test Project',
                'slug' => 'test-project',
                'security' => 1
            ],
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'Halo Today',
                'slug' => 'halo-today',
                'security' => 1
            ],
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'Lorem Project',
                'slug' => 'lorem-project',
                'security' => 1
            ],
            [
                'workspace_id' => mt_rand(1, 5),
                'category_id' => mt_rand(1, 3),
                'title' => 'Test Program',
                'slug' => 'test-program',
                'security' => 1
            ]
        );

        DB::table('projects')->insert($projects);
    }
}
