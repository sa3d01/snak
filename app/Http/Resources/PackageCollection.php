<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PackageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data=[];
        foreach ($this as $obj){
            $images=[];
            foreach ((array)$obj->images as $image){
                $images[]=asset('media/images/package/'). '/' . $image;
            }
            $arr['id']=(int)$obj->id;
            $arr['name']=$obj->name['ar'];
            $arr['note']=$obj->note['ar'];
            $arr['price']=(double)$obj->price;
            $arr['color']=$obj->color;
            $arr['images']=$images;
            $data[]=$arr;
            $images=[];
        }
        return $data;
    }
}
