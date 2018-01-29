<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = factory(User::class)->create();
        $b = factory(\App\Models\Roles::class)->create();

        $a->hid = \Vinkla\Hashids\Facades\Hashids::connection('user')->encode($a->id);
        $a->save();
        $a->role()->sync([$b->id]);


    }
}
