<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = ['nombre', 'descripcion'];
    public function participants(){
        return $this->belongsToMany(Participant::class);
    }
}
