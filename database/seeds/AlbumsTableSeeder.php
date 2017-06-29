<?php

use Illuminate\Database\Seeder;
use App\Album;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a= new Album();
        $a->name="Czerwona płyta";
        $a->description="dsdfd dffsd f dsfadsAS GDFSD DASDFDDF";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date=date('Y-m-d');
        $a->artist_id=1;
        $a->save();
        $a->categories()->attach(1);

        $a= new Album();
        $a->name="Czerwona płyta";
        $a->description="dsdfd dffsd f dsfadsAS GDFSD DASDFDDF";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date=date('Y-m-d');
        $a->artist_id=1;
        $a->save();
        $a->categories()->attach(1);

        $a= new Album();
        $a->name="Czerwona płyta";
        $a->description="dsdfd dffsd f dsfadsAS GDFSD DASDFDDF";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date=date('Y-m-d');
        $a->artist_id=1;
        $a->save();
        $a->categories()->attach(1);

        $a= new Album();
        $a->name="Czerwona płyta";
        $a->description="dsdfd dffsd f dsfadsAS GDFSD DASDFDDF";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date=date('Y-m-d');
        $a->artist_id=1;
        $a->save();
        $a->categories()->attach(1);

        $a= new Album();
        $a->name="Czerwona płyta";
        $a->description="dsdfd dffsd f dsfadsAS GDFSD DASDFDDF";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date=date('Y-m-d');
        $a->artist_id=1;
        $a->save();
        $a->categories()->attach(1);

    }
}
