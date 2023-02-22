<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Walk extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded= ['id'];

    // protected $fillable = ['nama', 'langkah_terekam'];

    // protected $hidden=[];

}
