<?php

use App\Artist;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::create(['name'=>'Coma']);
        Artist::create(['name'=>'Kult']);
        Artist::create(['name'=>'Kazik']);
        Artist::create(['name'=>'LaoChe']);
        Artist::create(['name'=>'Luxtorpeda']);
        Artist::create(['name'=>'T Love']);
        Artist::create(['name'=>'Kult']);
        Artist::create(['name'=>'Perfect']);
    }
}
