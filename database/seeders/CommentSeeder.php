<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'task_id' => 1,
                'user_id' => 1,
                'body' => 'Looks good! Please make sure the layout is responsive.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 1,
                'user_id' => 2,
                'body' => 'I will review the design tomorrow.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 2,
                'user_id' => 1,
                'body' => 'Please integrate the API by the end of the week.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 3,
                'user_id' => 3,
                'body' => 'The data analysis looks great. Just a few tweaks needed.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 3,
                'user_id' => 2,
                'body' => 'I have made the necessary adjustments.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
