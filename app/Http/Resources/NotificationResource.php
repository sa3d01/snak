<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> (int)$this->id,
            'read'=> ($this->read == 'true') ? true : false,
            'note'=> $this->note,
            'published_from'=> $this->published_from()
        ];
    }
}
