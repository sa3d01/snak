<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use ModelBaseFunctions;

    private $route='package';
    private $images_link='media/images/package/';

    protected $fillable = ['name','note','price','images','color','status','more_details'];
    protected $casts = [
        'more_details' => 'json',
        'name' => 'json',
        'note' => 'json',
        'images' => 'array',
    ];

}
