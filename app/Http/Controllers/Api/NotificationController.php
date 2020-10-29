<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends MasterController
{
    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
        parent::__construct();
    }


    public function show($id)
    {
        if (!$this->model->find($id))
            return $this->sendError('not found');
        $single=$this->model->find($id);
        $single->update([
            'read'=>'true'
        ]);
        return $this->sendResponse(NotificationResource::make($this->model->find($id)));
    }
    public function index()
    {
//        $notifies_query=$this->model->where('receiver_id',\request()->user()->id);
//        $notifies_query=$this->model->whereIn('receivers',\request()->user()->id);
        $notifies=new NotificationCollection($this->model->where('receiver_id',\request()->user()->id)->orWhereJsonContains('receivers',[\request()->user()->id])->latest()->get());

        $unread=$this->model->where('receiver_id',\request()->user()->id)->where('read','false')->count();
        $response = [
            'status' => 200,
            'data' => $notifies,
            'unread'=>$unread
        ];
        return response()->json($response, 200);

    }
}
