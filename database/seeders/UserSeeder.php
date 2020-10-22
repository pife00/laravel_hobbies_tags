<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hobby;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::factory()
            ->times(50)
            ->create()
            ->each(function($user){
             Hobby::factory()
            ->times(rand(1,8))
            ->create([
                'user_id'=>$user->id
            ])->each(function($hobby){
                $tag_ids=range(1,4);
                shuffle($tag_ids);
                $assigment = array_slice($tag_ids,0,rand(0,4));
                foreach ($assigment as $key) {
                    DB::table('hobby_tag')->insert([
                        'hobby_id'=>$hobby->id,
                        'tag_id' =>$key,
                        'created_at'=>Now(),
                        'updated_at'=>Now()
                    ]);               
                }

            })
            ; 
            });
    }
}
