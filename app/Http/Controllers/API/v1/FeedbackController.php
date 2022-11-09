<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        //     return ;
        // }
    }

    public function store(Request $request)
    {

        if(Auth::check()){

            $validated = $request->validate([
                'complaint' => 'required|string',
                'questionNumber' => 'numeric',
                'questionId' => 'numeric',
            ]);
            
            $feedback = Feedback::create([
                'complaint' => $validated["complaint"],
                'questionNumber' => $validated["questionNumber"] ?? null,
                'user_id' => auth()->user()->id,
                'questionId' => $validated["questionId"] ?? null,
            ]);

            if($feedback){
                return ["message"=>"Your feedback was successfully submitted."];
            }

            return ["message"=>"You did not submit any feedback."];

        }

        return ["message"=>"Sorry, Please login and try again."];

    }

    public function show($question)
    {
        // The user is logged in...
        if (Auth::check()) {
            
            // $avaliableQuestion = Question::where('questionId', $question)->firstOrFail();

            // return $avaliableQuestion;
        }

        return ["message"=>"Please login and try again."];

    }
    // public function update()
    // {
        
    // }
    // public function delete()
    // {

    // }
}
