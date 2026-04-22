<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['hero_id', 'name', 'type', 'power'];

    public function hero(){
        return $this->belongsTo(Hero::class);
    }
}
