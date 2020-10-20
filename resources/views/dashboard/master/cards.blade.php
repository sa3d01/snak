<div class="row">
    <div class="col-sm-12">
        <div class="element-wrapper">
{{--            <div class="element-actions">--}}
{{--                <form class="form-inline justify-content-sm-end">--}}
{{--                    <select class="form-control form-control-sm rounded">--}}
{{--                        <option value="Pending">--}}
{{--                            Today--}}
{{--                        </option>--}}
{{--                        <option value="Active">--}}
{{--                            Last Week--}}
{{--                        </option>--}}
{{--                        <option value="Cancelled">--}}
{{--                            Last 30 Days--}}
{{--                        </option>--}}
{{--                    </select>--}}
{{--                </form>--}}
{{--            </div>--}}
            <h6 class="element-header">
                آخر الإحصائيات
            </h6>
            <div class="element-content">
                <div class="row">
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label">
                                الأعضاء
                            </div>
                            <div class="value">
                                {{\App\User::count()}}
                            </div>
{{--                            <div class="trending trending-up-basic">--}}
{{--                                <span>12%</span><i class="os-icon os-icon-arrow-up2"></i>--}}
{{--                            </div>--}}
                        </a>
                    </div>
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label">
                                الاشتركات الجديدة
                            </div>
                            <div class="value">
                                {{\App\Subscribe::where('status','pending')->count()}}
                            </div>
{{--                            <div class="trending trending-down-basic">--}}
{{--                                <span>12%</span><i class="os-icon os-icon-arrow-down"></i>--}}
{{--                            </div>--}}
                        </a>
                    </div>
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label">
                                الاشتركات المفعلة
                            </div>
                            <div class="value">
                                {{\App\Subscribe::where('status','approved')->count()}}
                            </div>
{{--                            <div class="trending trending-down-basic">--}}
{{--                                <span>12%</span><i class="os-icon os-icon-arrow-down"></i>--}}
{{--                            </div>--}}
                        </a>
                    </div>
{{--                    <div class="col-sm-4 col-xxxl-3">--}}
{{--                        <a class="element-box el-tablo" href="#">--}}
{{--                            <div class="label">--}}
{{--                                New Customers--}}
{{--                            </div>--}}
{{--                            <div class="value">--}}
{{--                                125--}}
{{--                            </div>--}}
{{--                            <div class="trending trending-down-basic">--}}
{{--                                <span>9%</span><i class="os-icon os-icon-arrow-down"></i>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="d-none d-xxxl-block col-xxxl-3">--}}
{{--                        <a class="element-box el-tablo" href="#">--}}
{{--                            <div class="label">--}}
{{--                                Refunds Processed--}}
{{--                            </div>--}}
{{--                            <div class="value">--}}
{{--                                $294--}}
{{--                            </div>--}}
{{--                            <div class="trending trending-up-basic">--}}
{{--                                <span>12%</span><i class="os-icon os-icon-arrow-up2"></i>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
