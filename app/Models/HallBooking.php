<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'date',
        'from',
        'to',
        'type',
        'description',
        'user_id',
        'module_id',
        'batch'
    ];   

    public function hall(){
        return $this->belongsTo('App\Models\Hall');
    }
    public function module(){
        return $this->belongsTo('App\Models\Module');
    }
}
