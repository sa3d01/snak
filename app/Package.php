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
    public function activate()
    {
        $action = route('admin.package.activate', ['id' => $this->attributes['id']]);
        if ($this->attributes['status'] === null || $this->attributes['status'] === 0) {
            $name = 'تفعيل';
            $key = 'success';
            $icon = 'check';
            $class = '';
        } else {
            $name = 'حظر';
            $key = 'danger';
            $icon = 'cancel';
            $class = 'block';
        }
        return "<a class='$class btn btn-$key btn-sm' data-href='$action' href='$action'><i class='os-icon os-icon-$icon-circle'></i><span>$name</span></a>";
    }
    public function imagesArray(){
        return $this->attributes['images'];
    }

}
