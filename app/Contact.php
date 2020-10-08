<?php

namespace App;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use ModelBaseFunctions;

    private $route='contact';
    private $images_link='media/images/contact/';

    protected $fillable = ['name','phone','email','message','read','more_details'];
    protected $casts = [
        'more_details' => 'json',
    ];
}
