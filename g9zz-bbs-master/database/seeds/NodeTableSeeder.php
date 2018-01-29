<?php

use Illuminate\Database\Seeder;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = factory(\App\Models\Nodes::class,1)->create();
        foreach ($a as $value) {
            $value->hid = \Vinkla\Hashids\Facades\Hashids::connection('node')->encode($value->id);
            $value->save();
        }
    }
}
