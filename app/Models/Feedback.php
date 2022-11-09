<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Feedback extends Model
{
    use HasFactory;
    use HasApiTokens;

    const TABLE = 'feedbacks';

    protected $table = Self::TABLE;

    protected $guarded = [
        
    ];
    
    protected $hidden = [
        'user_id',
        'questionId',
        'created_at',
        'updated_at'
    ];
}
