<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    function lang(){
        if (\request()->header('lang')){
            return \request()->header('lang');
        }else{
            return 'ar';
        }
    }
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
            'name'=> $this->name[$this->lang()],
            'note'=> $this->note[$this->lang()],
            'price'=>(double)$this->price,
            'color'=>$this->color,
            'images'=>$images

        ];
    }
}
