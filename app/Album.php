<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable=['name','description','release_date', 'url'];
    //protected $dateFormat = 'Y-m-d';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category','category_album');
    }

    /**
     * @return mixed
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->orderby('id','desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class ,'user_id');
    }

}
