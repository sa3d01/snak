<ul class="main-menu">
    <li class="sub-header">
        <span>الباقات</span>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-paperclip"></div>
            </div>
            <span>الباقات</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                الباقات
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-paperclip"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.package.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.package.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    <li class="sub-header">
        <span>البيانات العامة</span>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-map"></div>
            </div>
            <span>المستويات الدراسية</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                المستويات الدراسية
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-map"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.SchoolGrade.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.SchoolGrade.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-book"></div>
            </div>
            <span>المدارس والحضانات</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                المدارس والحضانات
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-book"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.School.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.School.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-battery-charging"></div>
            </div>
            <span>مواعيد التوصيل</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                مواعيد التوصيل
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-battery-charging"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.Break.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.Break.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
{{--    <li class=" has-sub-menu">--}}
{{--        <a href="#">--}}
{{--            <div class="icon-w">--}}
{{--                <div class="os-icon os-icon-settings"></div>--}}
{{--            </div>--}}
{{--            <span>الاعدادات العامة</span></a>--}}
{{--        <div class="sub-menu-w">--}}
{{--            <div class="sub-menu-header">--}}
{{--                الاعدادات العامة--}}
{{--            </div>--}}
{{--            <div class="sub-menu-icon">--}}
{{--                <i class="os-icon os-icon-settings"></i>--}}
{{--            </div>--}}
{{--            <div class="sub-menu-i">--}}
{{--                <ul class="sub-menu">--}}
{{--                    <li>--}}
{{--                        <a href="{{route('admin.setting')}}">عرض </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
    <li class="sub-header">
        <span>الاشتراكات</span>
    </li>
    <li class="has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-dollar-sign"></div>
            </div>
            <span>الاشتراكات</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                الاشتراكات
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-dollar-sign"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.subscribe.index')}}">قائمة البيانات</a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
</ul>
