<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Channel::create(['title'=>'Laravel']);
        Channel::create(['title'=>'PHP']);
        Channel::create(['title'=>'Paython']);
        Channel::create(['title'=>'Vue.js']);
        Channel::create(['title'=>'React.js']);
        Channel::create(['title'=>'C#']);

    }
}
