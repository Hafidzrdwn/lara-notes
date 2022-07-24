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

        $categories = array(
            [
                'name' => 'Plain Notes',
            ],
            [
                'name' => 'TodoList',
            ],
        );

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

        $notes = [
            'project_id' => 1,
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eveniet maxime commodi exercitationem pariatur vero inventore esse magni sunt quis animi qui iusto, debitis voluptatum, modi, possimus veritatis atque libero. Eos nobis itaque nulla molestiae! Quaerat voluptate voluptatibus tempore, nostrum mollitia error natus animi quos, fugit aliquam obcaecati ut! Facere nemo soluta laborum excepturi minus, corporis laudantium itaque natus nulla sunt amet eaque, rem in vitae quo voluptates perspiciatis sint molestias consequatur labore cupiditate rerum inventore. Cumque assumenda fuga consequuntur error enim quisquam, voluptatem, molestias quaerat excepturi distinctio odit eveniet deleniti! Error rem quasi ratione, dolor voluptatum dignissimos omnis dolorum quibusdam? Non eveniet facilis nihil quos quas illum voluptate, laborum cupiditate enim rem inventore amet delectus. Laborum debitis qui aperiam quis, id, iure voluptatibus nesciunt minima nam magnam esse eveniet saepe dolorem quam! Sunt neque fuga voluptatum suscipit explicabo perspiciatis adipisci maiores fugit. Debitis culpa aliquam repudiandae vel eius ea rerum autem consequatur corporis. Laborum omnis ex quidem, voluptates debitis reprehenderit recusandae dolorum iste esse expedita harum earum ipsum magnam at velit odio? Tempore odit, iusto dignissimos quos asperiores voluptatibus, officiis vitae obcaecati sint qui doloremque! Placeat id autem sapiente, cumque minima, quibusdam officia eos iste consequatur inventore odit culpa?',
            'font_size' => 16,
            'created_at' => now(),
            'updated_at' => now()
        ];

        // DB::table('categories')->insert($categories);
    }
}
