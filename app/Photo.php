<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $uploads = '/images/';
    protected $fillable=['file','size'];

    public function getFileAttribute($value)
    {
        return $this->uploads.$value;
    }
}
