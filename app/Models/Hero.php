<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['name','class','level', 'alive' ];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function quests(){
        return $this->hasMany(Quest::class);
    }
}
