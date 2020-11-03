@extends('dashboard.master.base')
@section('title','الاعدادات العامة')
@section('style')
    <link rel="stylesheet" href="{{asset('panel/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            {!! Form::open(['method'=>'post', 'files'=>true, 'enctype' => 'multipart/form-data', 'route'=>'admin.setting.update', 'class' => 'formValidate']) !!}
                            {!! Form::hidden('updated_by', \Illuminate\Support\Facades\Auth::user()->id) !!}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="os-icon os-icon-wallet-loaded"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">
                                            الإعدادات العامة
                                        </h5>
                                        <div class="element-inner-desc">
                                            يرجى تحرى الحظر خﻻل عمليات التعديل فى هذه التعديﻻت
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for=""> عدد أيام الاعداد </label>
                                                <input type="number" min="1" max="31" name="standby_days" value="{{$row->standby_days}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for=""> رابط جوجل بلاي </label>
                                                <input type="url" name="android" value="{{$row->app_links['android']}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for=""> رابط اب استور </label>
                                                <input type="url" name="ios" value="{{$row->app_links['ios']}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <i class="os-icon os-icon-file-text"></i>
                                                <label> عن التطبيق باللغة العربية</label>
                                                <textarea name="about_ar" class="form-control" cols="80" rows="5">{{$row->about['ar']}}</textarea>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <i class="os-icon os-icon-file-text"></i>
                                                <label> عن التطبيق باللغة الانجليزية</label>
                                                <textarea name="about_en" class="form-control" cols="80" rows="5">{{$row->about['en']}}</textarea>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <i class="os-icon os-icon-file-text"></i>
                                                <label> شروط الاستخدام باللغة العربية </label>
                                                <textarea name="licence_ar" class="form-control" cols="80" rows="5">{{$row->licence['ar']}}</textarea>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <i class="os-icon os-icon-file-text"></i>
                                                <label> شروط الاستخدام باللغة الانجليزية </label>
                                                <textarea name="licence_en" class="form-control" cols="80" rows="5">{{$row->licence['en']}}</textarea>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            <div class="form-buttons-w">
                                <button class="btn btn-primary create-submit" type="submit"> تعديل</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('panel/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    @if($errors->any())
        <div style="visibility: hidden" id="errors" data-content="{{$errors}}"></div>
        <script type="text/javascript">
            $(document).ready(function () {
                var errors=$('#errors').attr('data-content');
                $.each(JSON.parse(errors), function( index, value ) {
                    console.log(value)
                    $('#'+index).notify(
                        value,
                        'error',
                        { position:"top" }
                    );
                });
            })
        </script>
    @endif
@stop
