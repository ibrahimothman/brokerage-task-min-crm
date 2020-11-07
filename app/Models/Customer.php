<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function workWith()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


    protected static function booted()
    {
        static::created(function ($customer) {
            // assign the created customer to the auth user
            // if he is am employee
            if (!auth()->user()->isAdmin()) {
                $customer->employee_id = auth()->user()->employee->id;
                $customer->save();
            }
        });
    }
}
