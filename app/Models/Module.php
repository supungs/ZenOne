<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name'
    ];   

    public function bookings(){
        return $this->hasMany(HallBookings::class, 'module_id');
    }
}
