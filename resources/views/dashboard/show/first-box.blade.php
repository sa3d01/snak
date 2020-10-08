<div class="up-head-w" style="background-image:url({{$row->image}})">
    @if(isset($socials))
        <div class="up-social">
            @foreach($socials as $social)
                <a target="_blank" href="{{$social->link}}">
                    <i class="os-icon os-icon-{{$social->name}}"></i>
                </a>
            @endforeach
        </div>
    @endif
    <div class="up-main-info">
        <h2 class="up-header">
            {{$row->name}}
        </h2>
        @if(isset($rate))
            <h6 class="up-sub-header">
                {!!$row->getStatusIcon()!!}
            </h6>
        @endif
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
        <div class="col-sm-6 text-right">
            @if(!($row->id == Auth::user()->id && $type=='admin'))
                {!! $row->activate() !!}
            @endif
        </div>
    </div>
</div>
