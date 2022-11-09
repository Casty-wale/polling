<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\HelperID;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\QuestionRequest;
use App\Http\Resources\v1\QuestionCollection;
use App\Http\Resources\v1\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class QuestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::check()) {

            $questions = Question::whereDate('endDate', '>=', now())
            ->orwhereNULL('endDate')
            ->get();

            // return $questions;
            // return (new QustionResource($questions))->response()->setStatusCode(200);
            return (new QuestionCollection($questions))->response()->setStatusCode(200);
        // }
    }

    public function store(QuestionRequest $request)
    {
        $questID = HelperID::IDgenerator(new Question, 'questionId');


        $questionName = $questID['questionId'].".xml";
        $category = $request["category"] ?? null;
        $name = $request["file"]->getClientOriginalName();
        $extension = $request["file"]->getClientOriginalExtension();
        $allName = explode(".", $name);
        $nameExtens = $allName[1];

        


        if($extension === $nameExtens){
            
            if(!Storage::disk('public')->exists("questionLog/".$category."/".$questionName)){
                $filePath = Storage::putFileAs('public/questionLog/'.$category, $request["file"], $questionName, 'public');

                $questionLog = Question::create([
                    'id' => $questID['id'],
                    'organisation' => $request["organisationName"],
                    'questionId' => $questID['questionId'],
                    'description' => $request["description"] ?? null,
                    'previousName' => $name,
                    'questionName' => $questID['questionId'].".xml",
                    'category' => $category,
                    'priority' => $request["priority"] ?? 3,
                    'questionPath' => $filePath,
                    'critirial' => $request["critirial"] ?? null,
                    'startDate' => $request["startDate"],
                    'endDate' => $request["endDate"] ?? null,
                    // 'user_id' => auth()->user()->id,
                ]);

                // return $questionLog.":- New file uploaded";
                return (new QuestionResource($questionLog))->response()->setStatusCode(201);
            };

            return ["error"=>$name.":- This file already exist with the same question ID."];
        }

        return ["error"=>"Error configuring file, please try again later."];

    }

    public function downloadable($id)
    {
        $filePath = Question::where('questionId', $id)->value("questionPath");

        // $url = Storage::url($filePath);

        // if(Storage::disk('public')->exists("questionLog/$category".".xml")){
        if($filePath){

            if(Storage::exists($filePath)){
                
                return Storage::download($filePath);
            }

            return ["message"=>"Cannot find this file."];
        }

        return ["message"=>"The file with ID ".$id." does not exist."];

    }

    public function show($question)
    {
        // The user is logged in...
        // if (Auth::check()) {
            
            $avaliableQuestion = Question::where('questionId', $question)->firstOrFail();

            return (new QuestionResource($avaliableQuestion))->response()->setStatusCode(200);
        // }

        // return ["message"=>"Please login and try again."];

    }
    public function update()
    {

    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id)->delete();

        return ["message"=>"Question successfully deleted. Thank you."];
    }
}
