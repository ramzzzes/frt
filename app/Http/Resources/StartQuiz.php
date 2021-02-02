<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StartQuiz extends JsonResource
{
    private $quiz;
    private $session;
    private $answerList;

    public function __construct($resource,$session)
    {
        self::$wrap = null;
        parent::__construct($resource);
        $this->quiz = $resource;
        $this->session = $session;
    }

    /**
     * Transform the resource into an array.
     * @param $request
     * @return array
     */

    public function toArray($request): array
    {
        foreach ($this->resource->quotes as $quote) {
            foreach ($quote->answers as $answer) {
                $answer->makeHidden('right');
            }
        }

        return [
            'session' => $this->session,
            'quiz' => $this->resource
        ];
    }
}
