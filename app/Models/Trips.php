<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;
    public $table="trips";
    public function seats()
    {
        return $this->hasMany(Seats::class);
    }
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
