<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images=[];
        foreach ((array)$this->images as $image){
            $images[]=asset('media/images/package/'). '/' . $image;
        }
        return [
            'id'=> (int)$this->id,
            'name'=> $this->name['ar'],
            'note'=> $this->note['ar'],
            'price'=>(double)$this->price,
            'color'=>$this->color,
            'images'=>$images

        ];
    }
}
