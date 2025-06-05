<?php

namespace App\Models\Addon\AI;
use Illuminate\Database\Eloquent\Model;

class OpenAIPrompt extends Model
{
    protected $fillable = [
        'is_image',
        'category',
        'prompt',
        'status',
    ];
}
