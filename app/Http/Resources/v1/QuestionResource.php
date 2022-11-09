<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public static $wrap = 'Questions';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            // 'type' => 'Question',
            'id' => $this->id,
            'attributes' => [
                'question_ID' => $this->questionId,
                'organisation' => $this->organisation,
                'description' => $this->description,
                'questionName' => $this->questionName,
                'category' => $this->category,
                'critirial' => $this->critirial,
                'priority' => $this->priority,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
                'deleted_at' => $this->deleted_at,
                'download' => route('download.get', $this->questionId),
            ]
        ];
    }

    public function with($request)
    {
        return[
            'status' => 'success',
        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
        $response->header('Version', '1.0.0');
    }
}

