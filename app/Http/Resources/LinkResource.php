<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'link' => $this->link,
            'shortlink' => url('/' . $this->shortlink),
            'user_id' => $this->whenLoaded('user'),
            'views' => $this->whenLoaded('views', function () {
                return $this->views->count();
            }),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
