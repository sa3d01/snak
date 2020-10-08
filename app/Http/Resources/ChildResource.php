<?php

namespace App\Http\Resources;

use App\Subscribe;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //pending,approved,rejected,unsubscribed
        if (Subscribe::where(['child_id'=>$this->id, 'status'=>1])->first()){
            $subscribed='approved';
        }else{
            $subscribed='unsubscribed';
        }
        return [
            'id'=> (int)$this->id,
            'name'=> $this->name,
            'gender'=>$this->gender,
            'grade'=>DropDownResource::make($this->grade),
            'section_name'=>$this->section_name ?? '',
            'school'=>DropDownResource::make($this->school),
            'birth_date'=>$this->birth_date ?? '',
            'child_like'=>$this->child_like ?? '',
            'child_dislike'=>$this->child_dislike ?? '',
            'health_warnings'=>$this->health_warnings ?? '',
            'additional_notes'=>$this->additional_notes ?? '',
            'subscribed'=>$subscribed

        ];
    }
}
