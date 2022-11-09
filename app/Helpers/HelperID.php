<?php

namespace App\Helpers;

class HelperID{

    public static function IDGenerator($model, $trow, $length = 15){

        $data = $model::orderBy('questionId','desc')->first('questionId');
        $dataID = $model::orderBy('id','desc')->first('id');

        define("pundit", date('hdims')); //Push the date and time in "pundit".

        define("determiner", 1);

        // return $last_number;

        if(!$data){
            $dataID = $dataID + 1;
            $og_length = $length - (strlen(determiner.pundit));
            $last_number = (determiner.pundit);
        }else{
            $dataID = $dataID->id + 1;
            // $code = substr($data->$trow, strlen($prefix)+1); Was working for lara 8. but not for 9.
            $code1 = (int)($data->questionId);
            $code = (int)substr($code1, 0, -10); //Remove the last 10 digits offset 0.
            // $code = (int)substr($code1, 0, -10);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ($actial_last_number)+1;
            $complete_last_number = ($increment_last_number.pundit);
            $last_number_length = strlen($complete_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $complete_last_number;
        }


        // $dataID = $dataID->id + 1;

        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        // return $prefix.'-'.$zeros.$last_number;
        // return $zeros.$last_number;
        return [
            "id" => $dataID,
            "questionId" => $zeros.$last_number,
        ];

    }
    public static function ANSIDGenerator($model, $trow, $length = 15){

        $data = $model::orderBy('answerId','desc')->first('answerId');

        define("ans_pundit", date('hdims')); //Push the date and time in "pundit".

        define("ans_determiner", 1);

        // return $last_number;

        if(!$data){
            $og_length = $length - (strlen(ans_determiner.ans_pundit));
            $last_number = (ans_determiner.ans_pundit);
        }else{
            // $code = substr($data->$trow, strlen($prefix)+1); Was working for lara 8. but not for 9.
            $code1 = (int)($data->answerId);
            $code = (int)substr($code1, 0, -10); //Remove the last 10 digits offset 0.
            // $code = (int)substr($code1, 0, -10);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ($actial_last_number)+1;
            $complete_last_number = ($increment_last_number.ans_pundit);
            $last_number_length = strlen($complete_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $complete_last_number;
        }

        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        
        return $zeros.$last_number;

    }

}


?>