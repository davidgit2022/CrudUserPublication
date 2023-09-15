<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'author_id');
    }


}
