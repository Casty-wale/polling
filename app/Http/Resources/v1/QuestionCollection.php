<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionCollection extends ResourceCollection
{

    public static $wrap = 'Questions';
    
     /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'Questions' => $this->collection,
        ];
    }

    // sending a success reponse to the client when proccess complete.
    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }

    // setting the response and version of the app through the header
    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
        $response->header('Version', '1.0.0');
    }
}