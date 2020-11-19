@extends('dashboard.master.base')
@section('title',$title)
@section('content')
    <div class="content-i">
        <div class="content-box">
            <div class="row">
{{--                first box--}}
                <div class="col-sm-5">
                    <div class="user-profile compact">
                        <div class="up-head-w" style="background-image:url({{$row->child->parent->image}})">
                            <div class="up-main-info">
                                <h2 class="up-header">
                                    {{$row->name}}
                                </h2>
                                <h6 class="up-sub-header">
{{--                                    {!!$row->getRateIcon()!!}--}}
                                </h6>
                            </div>
                            <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF">
                                    <path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="up-controls">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="value-pair">
                                        <div class="label" style="font-size: large">
                                            الحالة
                                        </div>
                                        <div class="icon-action-redo">
                                            {!!$row->getStatusIcon()!!}
                                        </div>
                                    </div>
                                </div>
                                @if($row->status=='pending')
                                <div class="col-sm-6 text-right">

                                    {!! $row->pay() !!}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
{{--                end first box--}}
{{--                show fields--}}
                <div class="col-sm-7">
                    <div class="element-wrapper">
                        <div class="element-box">
                                <div class="element-info">
                                    <div class="element-info-with-icon">
                                        <div class="element-info-icon">
                                            <div class="os-icon os-icon-wallet-loaded"></div>
                                        </div>
                                        <div class="element-info-text">
                                            <h5 class="element-inner-header">
                                                البيانات
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group" id="parent">
                                                <label for=""> ولى الأمر</label>
                                                <a href="{{route('admin.user.show',$row->child->parent_id)}}">
                                                <input disabled name="parent" class="form-control" value="{{$row->child->parent->name}}" type="text">
                                                </a>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="address">
                                                @foreach($row->child->parent->address as $key_add=>$value_add)
                                                    <label for=""> {{$key_add}} </label>
                                                    <input disabled class="form-control" value="{{$value_add}}" type="text">
                                                @endforeach
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="child">
                                                <label for="">  الطفل</label>
                                                <a href="{{route('admin.child.show',$row->child->id)}}">
                                                <input disabled name="child" class="form-control" value="{{$row->child->name}}" type="text">
                                                </a>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="child">
                                                <label for="">  ما يحبه الطفل</label>
                                                <input disabled name="child_like" class="form-control" value="{{$row->child->child_like}}" type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="child">
                                                <label for="">  ما لا يحبه الطفل</label>
                                                <input disabled name="child_dislike" class="form-control" value="{{$row->child->child_dislike}}" type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="child">
                                                <label for="">  ممنوعات للطفل</label>
                                                <input disabled name="health_warnings" class="form-control" value="{{$row->child->health_warnings}}" type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="package">
                                                <label for="">  الباقة</label>
                                                <a href="{{route('admin.package.show',$row->package->id)}}">
                                                <input disabled name="package" class="form-control" value="{{$row->package->name['ar']}}" type="text">
                                                </a>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="break">
                                                <label for="">  ميعاد التوصيل</label>
                                                <input disabled name="break" class="form-control" value="{{$row->break->name['ar']}}" type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            @php($now=Carbon\Carbon::now())
                                            <div class="form-group" id="days">
                                                <label for="">أيام التوصيل</label>
                                                @foreach($row->more_details['subscribed_days'] as $day)
                                                <input style= "@if($day < $now)  color:green @else color:orange @endif "  disabled name="days" class="form-control" value="{{$row->ArabicDate($day)}}" type="text">
                                                @endforeach
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" id="price">
                                                <label for="">  السعر قبل الخصم </label>
                                                <input disabled name="price" class="form-control" value="{{$row->more_details['subscribe_price']['real_price']}} جنيه " type="text">
                                                <label for=""> الخصم </label>
                                                <input disabled name="price" class="form-control" value="{{$row->more_details['subscribe_price']['discount']}} جنيه " type="text">
                                                <label for="">  السعر النهائى </label>
                                                <input disabled name="price" class="form-control" value="{{$row->more_details['subscribe_price']['price']}} جنيه " type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                        </div>
                    </div>
                </div>
{{--                end show fields--}}
            </div>
{{--            <div  class="table-responsive">--}}
{{--                <table id="datatable" width="100%" class="table table-striped table-lightfont">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th hidden></th>--}}
{{--                        <th>الرقم التسلسلى</th>--}}
{{--                        <th>التكلفة الاجمالية للطلب</th>--}}
{{--                        <th>نسبة التطبيق</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tfoot>--}}
{{--                    <tr>--}}
{{--                        <th hidden></th>--}}
{{--                        <th>الرقم التسلسلى</th>--}}
{{--                        <th>التكلفة الاجمالية للطلب</th>--}}
{{--                        <th>نسبة التطبيق</th>--}}
{{--                    </tr>--}}
{{--                    </tfoot>--}}
{{--                    <tbody>--}}
{{--                    @foreach($rows as $row)--}}
{{--                        <tr>--}}
{{--                            <td hidden>{{$row->id}}</td>--}}
{{--                            <td><a href="{{route('admin.order.show',$row->order_id)}}"># {{$row->order_id}}</a></td>--}}
{{--                            <td>{{$row->order->price}}</td>--}}
{{--                            <td>{{$row->app_ratio}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}

        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '#wallet_decrement', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'من فضلك أدخل القيمة التى تم سدادها',
                input: 'number',
                showCancelButton: true,
                confirmButtonText: 'تسديد',
                cancelButtonText: 'الغاء',
                showLoaderOnConfirm: true,
                preConfirm: (wallet_decrement_value) => {
                    $.ajax({
                        url: $(this).data('href'),
                        type:'GET',
                        data: {wallet_decrement_value}
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(() => {
                location.reload(true);
            })
        });
    </script>
    <script type="text/javascript">
        let map;
        let marker;
        function initMap() {
            // show map
            let lat_str = document.getElementById('map').getAttribute("data-lat");
            let long_str = document.getElementById('map').getAttribute("data-lng");
            let uluru = {lat:parseFloat(lat_str), lng: parseFloat(long_str)};
            let centerOfOldMap = new google.maps.LatLng(uluru);
            let oldMapOptions = {
                center: centerOfOldMap,
                zoom: 9
            };
            map = new google.maps.Map(document.getElementById('map'), oldMapOptions);
            marker = new google.maps.Marker({position: centerOfOldMap,animation:google.maps.Animation.BOUNCE});
            marker.setMap(map);
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
@endsection
