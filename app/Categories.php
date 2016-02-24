<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    public $timestamps = false;

    public function fields()
    {
        return $this->belongsToMany('App\Fields')->withTimestamps();
    }

    public function getFieldList()
    {
        return $this->fields->lists('id')->toArray();
    }
}
