<?php

namespace App\Http\Resources;

use App\Subscribe;
use Carbon\Carbon;
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
        if (Subscribe::where('child_id',$this->id)->latest()->first()){
            $subscribe=Subscribe::where(['child_id'=>$this->id])->latest()->first();
            $last_subscribe_day=Carbon::parse(end($subscribe->value('more_details')['subscribed_days']));
            if($last_subscribe_day<=Carbon::now()){
                $subscribed='unsubscribed';
            }else{
                $subscribed = ($last_subscribe_day->diff(Carbon::now())->days <= 3)
                    ? 'will_expire'
                    : Subscribe::where(['child_id'=>$this->id])->latest()->value('status');
            }
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
            'subscribed'=>$subscribed,
            'birth_date'=>$this->birth_date ?? '',
            'child_like'=>$this->child_like ?? '',
            'child_dislike'=>$this->child_dislike ?? '',
            'health_warnings'=>$this->health_warnings ?? '',
            'additional_notes'=>$this->additional_notes ?? '',

        ];
    }
}
