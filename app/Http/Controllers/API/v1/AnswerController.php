<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\HelperID;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        //     return ;
        // }
    }

    public function store(Request $request)
    {

        // if(Auth::check()){
            $answerID = HelperID::ANSIDGenerator(new Answer, 'answerId');

            $validated = $request->validate([
                'questionId' => 'required|numeric|exists:questions,questionId',
                'answer' => 'required',
                'answer.*' => 'required',
                // 'date' => 'required|date',
            ]);

            // $questionNumber = count($request->answer);
            // return $questionNumber;
            
            if($request->answer){
                $i = 0;
                $questionNumber = array_keys($validated["answer"]);
                $answers = count($request->answer);

                do {
                    $answerLog = Answer::create([
                        'answerId' => $answerID,
                        // 'answers' => $validated["answer"][$questionNumber[$i]],
                        // 'questionNumber' => $questionNumber[$i],
                        'answers' => $validated["answer"][$i]["answer"],
                        'questionNumber' => $validated["answer"][$i]["number"],
                        'latitude' => $validated["answer"][$i]["latitude"] ?? null,
                        'longitude' => $validated["answer"][$i]["longitude"] ?? null,
                        'questionId' => $validated["questionId"],
                        // 'user_id' => auth()->user()->id,
                        'created_at' => $validated["answer"][$i]["date"],
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                    $i++;
                } while ($i < $answers);
                
                if($i++ === $answers){
                    return ["message"=>"All answers were saved successfully."];
                }
                return ["error"=>"Something went wrong."];
            }

            return ["message"=>"You did not submit any answer."];

        // }

        // return ["message"=>"Sorry, Please login and try again."];

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
    public function update()
    {
        
    }
    public function delete($id)
    {
        $question = Answer::findOrFail($id)->delete();

        return ["message"=>"Answers successfully deleted. Thank you."];
    
    }
}
