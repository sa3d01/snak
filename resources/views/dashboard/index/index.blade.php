@extends('dashboard.master.base')
@section('title',$title)
@section('style')
    <style>
        .image-upload > input {
            visibility:hidden;
            width:0;
            height:0
        }
    </style>
@endsection
@section('content')
    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <div class="element-box">
                    <h5 class="form-header">
                        {{$title}}
                    </h5>
                    @if($type!='subscribe' && $type!='user')
                    <div class="form-buttons-w">
                        <a href="{{route('admin.'.$type.'.create')}}" class="btn btn-primary create-submit" ><label>+</label> إضافة</a>
                    </div>
                    @endif
                    <div  class="table-responsive">
                        <table id="datatable" width="100%" class="table table-striped table-lightfont">
                            <thead>
                            <tr>
                                <th hidden></th>
                                @foreach($index_fields as $key=>$value)
                                    <th>{{$key}}</th>
                                @endforeach
                                @if(isset($status))
                                    <th>الحالة</th>
                                @endif
                                @if(isset($selects))
                                    @foreach($selects as $select)
                                        <th>{{$select['title']}}</th>
                                    @endforeach
                                @endif
                                @if(isset($image) || isset($images))
                                    <th>الصورة</th>
                                @endif
                                @if($type=='user')
                                    <th>عدد الأطفال</th>
                                    <th>العنوان</th>
                                @endif
                                <th>المزيد</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th hidden></th>
                                @foreach($index_fields as $key=>$value)
                                    <th>{{$key}}</th>
                                @endforeach
                                @if(isset($status))
                                    <th>الحالة</th>
                                @endif
                                @if(isset($selects))
                                    @foreach($selects as $select)
                                        <th>{{$select['title']}}</th>
                                    @endforeach
                                @endif
                                @if(isset($image) || isset($images))
                                    <th>الصورة</th>
                                @endif
                                @if($type=='user')
                                    <th>عدد الأطفال</th>
                                    <th>العنوان</th>
                                @endif
                                <th>المزيد</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td hidden>{{$row->id}}</td>
                                    @foreach($index_fields as $key=>$value)
                                        @if($value=='created_at')
                                            <td>{{$row->published_at()}}</td>
                                        @elseif(substr($value, "-3")=='_id')
                                            @php
                                                $related_model=substr_replace($value, "", -3);
                                                try {
                                                    $related_model_val=$row->$related_model->name['ar'];
                                                }catch (Exception $e){
                                                    $related_model_val='';
                                                }
                                            @endphp
                                            <td>{{$related_model_val}}</td>
                                        @elseif($value=='start_date' || $value=='end_date')
                                            <td>{{$row->showTimeStampDate($row->$value)}}</td>
                                        @elseif($value=='role')
                                            @if($row->hasRole(\Spatie\Permission\Models\Role::all()))
                                                <td>{{$row->getRoleArabicName()}}</td>
                                            @else
                                                ﻻ يمتلك أي صﻻحيات حتى الآن
                                            @endif
                                        @elseif($type=='role' && $value=='users_count')
                                            <td>{{$row->users()->count()}}</td>
                                        @else
                                            @if(is_array($row->$value))
                                                <td>{{$row->$value['ar']}}</td>
                                            @else
                                                <td>{{$row->$value}}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if(isset($status))
                                        <td>
                                            {!!$row->getStatusIcon()!!}
                                        </td>
                                    @endif
                                    @if(isset($selects))
                                        @foreach($selects as $select)
                                            @php($related_model=$select['name'])
                                            <td><a href="{{route('admin.'.$related_model.'.show',$row->$related_model->id)}}"> {{$row->$related_model ? $row->$related_model->nameForSelect() : ''}}</a></td>
                                        @endforeach
                                    @endif
                                    @if(isset($image))
                                        <td><img width="50px" height="50px" src="{{$row->image}}"></td>
                                    @elseif(isset($images))
                                        <td><img style="border-radius: 10px;" width="50px" height="50px" src="{{asset('media/images/').'/'.$type.'/'.$row->images[0]}}"></td>
                                    @endif
                                    @if($type=='user')
                                        <td>{{count($row->children)}}</td>
                                        <td>
                                        @if($row->address!=null)
                                            @foreach($row->address as $key=>$address)
                                                    {{$address}} ,
                                            @endforeach
                                        @endif
                                        </td>
                                    @endif

                                    <td>
                                        @if($type!='user')
                                        <div class=" row border-0">
                                            <div class="col-sm-3 mx-auto text-center">
                                                <a href="{{route('admin.'.$type.'.show',$row->id)}}"><i class="os-icon os-icon-grid-10"></i></a>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            var Table = $('#datatable').DataTable({
                "order": [[ 0, "desc" ]],
                "oLanguage": {
                    "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing":   "جارٍ التحميل...",
                    "sLengthMenu":   "أظهر _MENU_ مدخلات",
                    "sZeroRecords":  "لم يعثر على أية سجلات",
                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix":  "",
                    "sSearch":       "ابحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "الأول",
                        "sPrevious": "السابق",
                        "sNext":     "التالي",
                        "sLast":     "الأخير"
                    },
                    "oAria": {
                        "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                },
                // "iDisplayLength": -1,
                // "sPaginationType": "full_numbers",
            });
//length of rows
            var rows=Table.rows().data();
            $(
                ".filters-groups .date-picker-max, .filters-groups .date-picker-min"
            ).change(function() {
                var val = parseInt((new Date(this.value).getTime() / 1000).toFixed(0));
                var op = "min";
                if ($(this).hasClass("date-picker-max")) {
                    op = "max";
                }
                Table.rows().every(function() {
                    var row_id=this.data()[0];
                    var date = Date.parse(this.data()[1])/1000;
                    if (date) {
                        if (op === "min") {
                            if (date < val) {
                                $('#'+row_id).hide();
                            } else {
                                $('#'+row_id).show();
                            }
                        } else {
                            if (date > val) {
                                $('#'+row_id).hide();
                            } else {
                                $('#'+row_id).show();
                            }
                        }
                    }
                });
                Table.draw();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "هل انت متأكد من الحذف ؟",
                text: "لن تستطيع استعادة هذا العنصر مرة أخرى!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم , قم بالحذف!',
                cancelButtonText: 'ﻻ , الغى عملية الحذف!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
    </script>
@endsection

