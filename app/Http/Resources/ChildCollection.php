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
            if (Subscribe::where('child_id',$obj->id)->first()){
                $subscribed=Subscribe::where(['child_id'=>$obj->id])->latest()->value('status');
            }else{
                $subscribed='unsubscribed';
            }
            $arr['id']=(int)$obj->id;
            $arr['name']=$obj->name;
            $arr['gender']=$obj->gender;
            $arr['grade']=DropDownResource::make($obj->grade);
            $arr['school']=DropDownResource::make($obj->school);
            $arr['subscribed']=$subscribed;
            $arr['birth_date']=$obj->birth_date ?? '';
            $arr['child_like']=$obj->child_like ?? '';
            $arr['child_dislike']=$obj->child_dislike ?? '';
            $arr['health_warnings']=$obj->health_warnings ?? '';
            $arr['additional_notes']=$obj->additional_notes ?? '';
            $data[]=$arr;
        }
        return $data;
    }
}
