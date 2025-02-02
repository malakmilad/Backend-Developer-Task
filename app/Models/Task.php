<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $guarded=[];
    //*to use soft delete at model

    use HasFactory,SoftDeletes,HasFactory;
}
