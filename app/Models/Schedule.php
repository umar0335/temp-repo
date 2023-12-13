<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','location_id','shift_id','day','time'];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function shift(){
        return $this->belongsTo(Shifts::class);
    }
}
