<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
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
            $arr['id']=(int)$obj->id;
            $arr['read']=($obj->read == 'true') ? true : false;
            $arr['note']=$obj->note;
            $arr['published_from']=$obj->published_from();
            $data[]=$arr;
        }
        return $data;
    }
}
