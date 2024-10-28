<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model

{


    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'course_enrolled',
        'phone',
        'dob'


    ];

    //enable disabling automatic timestamp
    public $timestamps = false;
}
