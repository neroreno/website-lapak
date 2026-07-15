<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedbacks'; // "feedback" uncountable di Inggris -> Laravel default ke 'feedback', padahal migration bikin 'feedbacks'

    protected $fillable = ['user_id', 'name', 'email', 'type', 'subject', 'message', 'status', 'response'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}