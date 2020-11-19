<ul class="main-menu">
    <li class="sub-header">
        <span>أولياء الأمور</span>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-user-male-circle"></div>
            </div>
            <span>أولياء الأمور</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                أولياء الأمور
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-user-male-circle"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.user.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

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
                <div class="os-icon os-icon-cloud-snow"></div>
            </div>
            <span>الحضانات</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                الحضانات
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-cloud-snow"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.School.list',['type'=>'nursery'])}}">قائمة الحضانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.SchoolGrade.list',['type'=>'nursery'])}}">قائمة المستويات الدراسية للحضانات </a>
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
            <span>المدارس</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                المدارس
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-book"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.School.list',['type'=>'school'])}}">قائمة المدارس</a>
                    </li>
                    <li>
                        <a href="{{route('admin.SchoolGrade.list',['type'=>'school'])}}">قائمة المستويات الدراسية للمدارس </a>
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
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-code"></div>
            </div>
            <span>كبونات الخصم</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                كبونات الخصم
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-code"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.PromoCode.index')}}">قائمة البيانات</a>
                    </li>
                    <li>
                        <a href="{{route('admin.PromoCode.create')}}">اضافة </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

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
                        <a href="{{route('admin.subscribe.index')}}">قائمة الاشتراكات</a>
                        <a href="{{route('admin.subscribe.today')}}">قائمة اشتراكات اليوم</a>
                        <a href="{{route('admin.subscribe.tomorrow')}}">قائمة اشتراكات الغد</a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    <li class="sub-header">
        <span>الاشعارات الجماعية </span>
    </li>
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-alert-octagon"></div>
            </div>
            <span>الاشعارات الجماعية </span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                الاشعارات الجماعية
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-alert-octagon"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('admin.notification.admin_notify_type',['admin_notify_type'=>'all'])}}"> الاشعارات العامة  </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>

    <li class="sub-header">
        <span>رسائل الأعضاء</span>
    </li>
    <li class="sub-menu">
        <a href="{{route('admin.contact.index')}}">
            <div class="icon-w">
                <div class="os-icon os-icon-email-2-at"></div>
            </div>
            <span>رسائل الأعضاء</span>
        </a>
    </li>

    <li class="sub-header">
        <span>الاعدادات العامة</span>
    </li>
    <li class="sub-menu">
        <a href="{{route('admin.setting')}}">
            <div class="icon-w">
                <div class="os-icon os-icon-server"></div>
            </div>
            <span>الاعدادات العامة</span>
        </a>
    </li>
</ul>
