<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Answer extends Model
{
    use HasFactory;
    use HasApiTokens;
    use SoftDeletes;
    use HasUser;

    const TABLE = 'answers';

    protected $table = Self::TABLE;

    protected $guarded = [
        
    ];
    
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'longitude',
        'latitude'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }

}
