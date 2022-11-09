<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Question extends Model
{
    use HasFactory;
    use HasApiTokens;
    use SoftDeletes;
    use HasUser;

    const TABLE = 'questions';

    protected $table = Self::TABLE;

    protected $guarded = [
        
    ];

    protected $primaryKey = 'questionId';
    
    protected $hidden = [
        'user_id',
        'previousName',
        'questionPath',
        'created_at',
        'updated_at'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
