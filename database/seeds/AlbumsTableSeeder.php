<?php

use Illuminate\Database\Seeder;
use App\Album;
use App\User;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::create([
        "name"=>"Czerwona płyta",
        "description"=>"dsdfd dffsd f dsfadsAS GDFSD DASDFDDF",
        "cover"=>"covers/zOP8i02l347aYKaTPgtPitjIwGa7QwHwuHpX6bNU.jpeg",
        "release_date"=>date('Y-m-d'),
        "artist_id"=>1,
        'user_id'=>1])
            ->categories()->attach([1,2,3,4]);



         Album::create([
         "name"=>"Wstyd",
         "description"=>"Wstyd – album studyjny polskiego zespołu muzycznego Kult. Wydawnictwo ukazało się 14 października 2016 roku nakładem wytwórni muzycznej S.P. Records. Materiał był promowany teledyskiem do utworu „Madryt” w reżyserii Sławomira Pietrzaka",
         "cover"=>"covers/vsYQHEA45zMrbU3K6RHrRRlgPGExygbLgz49jadM.jpg",
         "release_date"=>'2016-10-14',
         "artist_id"=>2,
         'user_id'=>1])
             ->categories()->attach([1,2]);

         Album::create([
         "name"=>"12 groszy",
         "description"=>"12 groszy – solowy album Kazika. Nagrań dokonano w piwnicy Oddalenie i w studiu Hard przy ulicy Kredytowej w Warszawie.",
         "cover"=>"covers/22x3FbEKfqW4FJE8KZJskWeuRphCuZVfLpaYGDPl.jpg",
         "release_date"=>'1997-06-24',
         "artist_id"=>3,
         'user_id'=>1])
             ->categories()->attach([4,3]);

         Album::create([
         "name"=>"Dziciom",
         "cover"=>"covers/YHXxnjn2sp5E29WhVBulISgzZspBzSIxYnX550Sk.jpg",
         "description"=>"Dzieciom – szósty album studyjny płockiego zespołu Lao Che wydany 6 marca 2015 przez Mystic Production, wyprodukowany przez Emade.",
         "release_date"=>'2015-03-15',
         "artist_id"=>4,
         'user_id'=>1])
             ->categories()->attach([2,5,3]);

         Album::create([
         "name"=>"MYWASWYNAS",
         "description"=>"MYWASWYNAS – czwarty długogrający album studyjny polskiego rockowego zespołu Luxtorpeda. Album został wydany 1 kwietnia 2016 roku przez S.D.C. (dystrybucja Universal Music Polska)",
         "cover"=>"covers/w5KjXHWiJVGDIQ1PcOHBHSIq9ffh2vUXBlwm7YTj.jpg",
         "release_date"=>'2016-04-01',
         "artist_id"=>5,
         'user_id'=>1])
             ->categories()->attach([4,1]);


    }
}
