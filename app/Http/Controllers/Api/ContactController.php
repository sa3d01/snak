<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\DropDown;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class ContactController extends MasterController
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    public function validation_rules($method, $id = null)
    {
        return [
            'message' => 'required',
        ];
    }
    public function validation_messages()
    {
        return array(
            'required' => ':attribute يجب ادخال الـ',
        );
    }


}
