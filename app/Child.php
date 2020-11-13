<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use ModelBaseFunctions;

    private $route='child';
    private $images_link='media/images/child/';

    protected $fillable = ['parent_id','name','gender','grade_id','section_name','school_id','birth_date',
        'child_like','child_dislike','health_warnings','additional_notes','image','more_details'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'more_details' => 'json',
    ];


    public function nameForSelect(){
        return $this->name;
    }
    //relations

    public function parent(){
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function grade(){
        return $this->belongsTo(DropDown::class,'grade_id','id');
    }
    public function school(){
        return $this->belongsTo(DropDown::class,'school_id','id');
    }
    public function subscribes(){
        return $this->hasMany(Subscribe::class,'child_id','id');
    }
}
