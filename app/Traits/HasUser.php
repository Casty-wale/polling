<?php

    namespace App\Traits;

use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
     * 
     */
    trait HasUser
    {
        // this helps to call on the user Model
        public function question(): Question
        {
            return $this->questionRelation;
        }
    
        // this is the relationship between the question and the answer
        public function questionRelation(): BelongsTo
        {
            return $this->belongsTo(Question::class, 'questionId');
        }

        // Confirm if the question was done by the user
        // public function isAnsweredby(Question $user): bool
        // {
        //     return $this->user()->matches($user);
        // }

        // Signing a user to a question
        // public function AnsweredBy(Question $user)
        // {
        //     return $this->questionRelation()->associate($user);
        // }

    }


?>