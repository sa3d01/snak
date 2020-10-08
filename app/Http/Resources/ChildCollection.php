<?php

namespace App\Http\Resources;

use App\Subscribe;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChildCollection extends ResourceCollection
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
            //pending,approved,rejected,unsubscribed
            if (Subscribe::where(['child_id'=>$obj->id, 'status'=>1])->first()){
                $subscribed='approved';
            }else{
                $subscribed='unsubscribed';
            }
            $arr['id']=(int)$obj->id;
            $arr['name']=$obj->name;
            $arr['gender']=$obj->gender;
            $arr['grade']=DropDownResource::make($obj->grade);
            $arr['school']=DropDownResource::make($obj->school);
            $arr['subscribed']=$subscribed;

            $data[]=$arr;
        }
        return $data;
    }
}
