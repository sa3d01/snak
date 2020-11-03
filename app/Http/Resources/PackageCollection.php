<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PackageCollection extends ResourceCollection
{
    function lang(){
        if (\request()->header('lang')){
            return \request()->header('lang');
        }else{
            return 'ar';
        }
    }
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
            $arr['name']=$obj->name[$this->lang()];
            $arr['note']=$obj->note[$this->lang()];
            $arr['price']=(double)$obj->price;
            $arr['color']=$obj->color;
            $arr['images']=$images;
            $arr['show_images']=$obj->show_images==0?false:true;
            $arr['delivery']=$obj->delivery==0?false:true;
            $data[]=$arr;
            $images=[];
        }
        return $data;
    }
}
