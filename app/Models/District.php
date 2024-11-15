<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /** @use HasFactory<\Database\Factories\DistrictFactory> */
    use HasFactory;

    protected $fillable = ['id', 'constituency_id', 'name'];

    // establish relationships
    public function constituency(){
        return $this->belongsTo(Constituency::class);
    }
    
    public function station(){
        return $this->hasMany(Station::class);
    }
}
