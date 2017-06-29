<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable=['name','description','release_date', 'url'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category','category_album');
    }
}
