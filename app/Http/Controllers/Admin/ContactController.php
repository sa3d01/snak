<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Notification;
use App\Page;
use App\User;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends MasterController
{
    public function __construct(Contact $model)
    {
        $this->model = $model;
        $this->route = 'contact';

        parent::__construct();
    }


    public function show_single_contact($id){
        if($id==0){
            $contact=Contact::latest()->first();
        }else{
            $contact=Contact::find($id);
        }
        if(!$contact)
            return response()->json(false);
        $contact->update(['read'=>'true']);
        $message=$contact->message;
        $name=$contact->name;
        $image=asset('media/images/user/default.jpeg');
        $published_at=$contact->published_from();
        $div_message="<div class='message-head'>
                            <div class='user-w with-status status-green'>
                                <div class='user-avatar-w'>
                                    <div class='user-avatar'>
                                       <img src='$image'>
                                    </div>
                                </div>
                                <div class='user-name'>
                                   <h6 class='user-title'>$name</h6>
                                </div>
                            </div>
                            <div class='message-info'>
                            <time>$published_at</time><br>
                            <code>$contact->email</code><br>
                            <code>$contact->phone</code><br>
                            </div>
                        </div>
                            <div class='message-content'>$message</div>";
        return response()->json(['div_message'=>$div_message,'replies'=>[]]);
    }
    public function single_contact_form($user_id,$contact_id){
        return View('dashboard.contact.create', [
            'user_id' => $user_id,
            'contact_id' => $contact_id,
            'type'=>'contact',
            'action'=>'admin.contact.send',
            'title'=>'رسالة إدارية',
            'create_fields'=>[ 'النص' => 'note'],
        ]);
    }
    public function index()
    {
        $rows = $this->model->latest()->get();
        return View('dashboard.contact.index', [
            'rows' => $rows,
            'type'=>'contact',
            'title'=>'قائمة الرسائل',
            'index_fields'=>['الرسالة' => 'message'],
        ]);
    }
    public function show($id)
    {
        $row = $this->model->findOrFail($id);
        return View('dashboard.show.show', [
            'row' => $row,
            'type'=>'page',
            'action'=>'admin.page.update',
            'title'=>'تفاصيل',
            'edit_fields'=>['العنوان' => 'title', 'النص' => 'note'],
            'status'=>true,
            'languages'=>true,
            'image'=>true,
        ]);
    }
    public function send_single_notify($receiver_id,$note){
        $data=[];
        $data['title']='رسالة إدارية';
        $data['receiver_id']=$receiver_id;
        $data['note']=$note;
        $data['type']='admin';
        Notification::create($data);
        $this->notify(User::find($receiver_id),$note);
        return true;
    }
    public function send_single_contact(Request $request){
        $data=[];
        $data['title']='رسالة إدارية';
        $data['receiver_id']=$request['user_id'];
        $data['note']=$request['note'];
        $data['type']='admin';
        $data['admin_notify_type']='single';
        $data['more_details']['contact_id']=$request['contact_id'];
        Notification::create($data);
        $this->notify(User::find($request['user_id']),$request['note']);
        return redirect()->route('admin.contact.index')->with('created');
    }

    public function notify($receiver,$note){
        if(array_key_exists("type",(array)$receiver->device)){
            if ($receiver->device['type'] =='IOS'){
                $fcm_notification=array('title'=>'رسالة إدارية', 'sound' => 'default');
            }else{
                $fcm_notification=null;
            }
        }
        $push = new PushNotification('fcm');
        $msg = [
            'notification' => $fcm_notification,
            'data' => [
                'title' => 'رسالة إدارية',
                'body' => $note,
                'status' => 'admin',
                'type'=>'admin',
            ],
            'priority' => 'high',
        ];
        $push->setMessage($msg)
            ->setDevicesToken($receiver->device['id'])
            ->send();
    }

}
