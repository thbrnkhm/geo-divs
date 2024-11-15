<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    /** @use HasFactory<\Database\Factories\ConstituencyFactory> */
    use HasFactory;

    protected $fillable = ['id', 'name'];

    // establish and define the relationships
    public function district(){
        return $this->hasMany(District::class);
    }
}
