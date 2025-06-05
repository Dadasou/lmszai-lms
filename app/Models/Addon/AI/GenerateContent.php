<?php

namespace App\Models\Addon\AI;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GenerateContent extends Model
{
    protected $fillable = [
        'user_id',
        'is_image',
        'service',
        'keywords',
        'creativity',
        'variation',
        'language',
        'prompt',
        'output',
        'token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
