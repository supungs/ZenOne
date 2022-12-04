<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'capacity'
    ];   

    public function bookings(){
        return $this->hasMany(HallBookings::class, 'hall_id');
    }
}
