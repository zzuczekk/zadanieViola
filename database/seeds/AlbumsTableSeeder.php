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
        $a=Album::create([
        "name"=>"Czerwona płyta",
        "description"=>"dsdfd dffsd f dsfadsAS GDFSD DASDFDDF",
        "url"=>"http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg",
        "release_date"=>date('Y-m-d'),
        "artist_id"=>1
            ]);
        $a->categories()->attach([1,2,3,4]);

        $a= new Album();
        $a->name="Wstyd";
        $a->description="Wstyd – album studyjny polskiego zespołu muzycznego Kult. Wydawnictwo ukazało się 14 października 2016 roku nakładem wytwórni muzycznej S.P. Records. Materiał był promowany teledyskiem do utworu „Madryt” w reżyserii Sławomira Pietrzaka";
        $a->url="http://www.sprecords.pl/public/images/produkty/oryginalne/382-455.jpg";
        $a-> release_date='2016-10-14';
        $a->artist_id=2;
        $a->save();
        $a->categories()->attach([1,2]);

        $a= new Album();
        $a->name="12 groszy";
        $a->description="12 groszy – solowy album Kazika. Nagrań dokonano w piwnicy Oddalenie i w studiu Hard przy ulicy Kredytowej w Warszawie.";
        $a->url="http://www.sprecords.pl/public/images/produkty/oryginalne/281-309.jpg";
        $a-> release_date='1997-06-24';
        $a->artist_id=3;
        $a->save();
        $a->categories()->attach([4,3]);

        $a= new Album();
        $a->name="Dziciom";
        $a->description="http://wsm.serpent.pl/sklep/okladki/okl_okl_48828.jpg";
        $a->url="Dzieciom – szósty album studyjny płockiego zespołu Lao Che wydany 6 marca 2015 przez Mystic Production, wyprodukowany przez Emade.";
        $a-> release_date='2015-03-15';
        $a->artist_id=4;
        $a->save();
        $a->categories()->attach([2,5,3]);

        $a= new Album();
        $a->name="MYWASWYNAS";
        $a->description="MYWASWYNAS – czwarty długogrający album studyjny polskiego rockowego zespołu Luxtorpeda. Album został wydany 1 kwietnia 2016 roku przez S.D.C. (dystrybucja Universal Music Polska)";
        $a->url="http://www.magazyngitarzysta.pl/images/media4i/a/a6/a6a/phpThumb_generated_thumbnailjpg_8.jpeg";
        $a-> release_date='2016-04-01';
        $a->artist_id=5;
        $a->save();
        $a->categories()->attach([4,1]);

    }
}
