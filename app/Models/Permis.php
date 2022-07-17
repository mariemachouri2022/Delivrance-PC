<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permis extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $perPage = 2;

    public function organisateur(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
