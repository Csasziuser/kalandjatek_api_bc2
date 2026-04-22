<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = ['hero_id', 'title','reward_gold','completed'];

    public function hero(){
        return $this->belongsTo(Hero::class);
    }
}
