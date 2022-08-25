<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    

    protected $fillable = [
       'first_name',
       'last_name',
       'email',
       'phone',
       'job',
       'salary',
       'department_id'
    ];


    public function department()
    {
        return $this->hasOne(Department::class);
    }
}
