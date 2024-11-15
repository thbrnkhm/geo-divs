<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /** @use HasFactory<\Database\Factories\StationFactory> */
    use HasFactory;
    protected $fillable = ['id', 'district_id', 'name'];


    // establish relationships
    public function district(){
        return $this->belongsTo(District::class);
    }
}
