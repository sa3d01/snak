@extends('dashboard.master.base')
@section('title',$title)
@section('style')

@endsection
@section('content')
    <div class="app-email-i">
        <!--------------------
        START - Email Side menu
        -------------------->
        <div class="ae-side-menu" hidden>

        </div>
        <!--------------------
        END - Email Side menu
        --------------------><!--------------------
    START - Email Messages List
    -------------------->
        <div class="ae-list-w">
            <div class="ae-list">
                @if(count($rows)<1)
                    <h4 class="text-center">ﻻ توجد رسائل بعد</h4>
                @endif
                @foreach($rows as $row)
                    <div id="{{$row->id}}" class="ae-item with-status @if ($loop->first) active @endif @if($row->read=='false') status-red @else status-green @endif">
                        <div class="aei-image">
                            <div class="user-avatar-w">
                                <img alt="{{$row->name}}" src="{{asset('media/images/user/default.jpeg')}}">
                            </div>
                        </div>
                        <div class="aei-content">
                            <div class="aei-timestamp">
                                {{$row->published_from()}}
                            </div>
                            <h6 class="aei-title">
                                {{$row->name}}
                            </h6>
                            <div class="aei-text">
                                {{$row->message}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--------------------
        END - Email Messages List
        -------------------->
        <div class="ae-content-w">
            <div class="ae-content">
                <div class="aec-full-message-w">
                    <div id="single_message" class="aec-full-message">
{{--                        siingle msg--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.ae-item').on('click', function (e) {
                e.preventDefault();
                var contact_id = $(this).attr('id');
                $.ajax({
                    type: "GET",
                    url:'/admin/show_single_contact/'+contact_id,
                    dataType: 'json',
                    success: function( data ) {
                        $('#single_message').empty();
                        $('#single_message').html(data['div_message']);
                    }
                });
            });
            $.ajax({
                type: "GET",
                url:'/admin/show_single_contact/0',
                dataType: 'json',
                success: function( data ) {
                    if(data===false){
                        $('#single_message').empty();
                        $('#single_message').html('<h4>ﻻ توجد رسائل</h4>');
                    }else{
                        $('#single_message').html(data['div_message']);
                    }
                }
            });
        });
    </script>

@endsection

