   @extends('layouts.common-template')
   @push('title')
       <title>Shuvecha - Dashboard</title>
   @endpush
   @section('body')
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!--[ daily sales section ] start-->
                                <div class="col-md-6 col-xl-3">
                                    <div class="card daily-sales">
                                        <div class="card-block">
                                            <h6 class="mb-1">Last One Year Sell</h6>

                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">{{$last_one_year_sale}}</h3>
                                                </div>
                                            </div>
                                            <h6 class="mt-3 mb-1">Today Sell</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">{{$today_sale}}</h3>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <p class="m-b-0"><i class="fas fa-long-arrow-alt-right"></i> Result</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[ daily sales section ] end-->
                                <!--[ Monthly  sales section ] starts-->
                                <div class="col-md-6 col-xl-3">
                                    <div class="card Monthly-sales">
                                        <div class="card-block">
                                            <h6 class="mb-1">Last One Year Profit</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">{{$last_one_year_profit}}</h3>
                                                </div>
                                            </div>
                                            <h6 class="mt-3 mb-1">Today Profit</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">{{$today_profit}}</h3>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <p class="m-b-0"><i class="fas fa-long-arrow-alt-right"></i> Result</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[ Monthly  sales section ] end-->
                                <!--[ year  sales section ] starts-->
                                <div class="col-md-12 col-xl-3">
                                    <div class="card yearly-sales">
                                        <div class="card-block">
                                            <h6 class="mb-1">Total Expenses</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">0</h3>
                                                </div>
                                            </div>
                                            <h6 class="mt-3 mb-1">Today Expenses</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">0</h3>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <p class="m-b-0"><i class="fas fa-long-arrow-alt-right"></i> Result</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-3">
                                    <div class="card yearly-sales">
                                        <div class="card-block">
                                            <h6 class="mb-1">Total Due</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">0</h3>
                                                </div>
                                            </div>
                                            <h6 class="mt-3 mb-1">Today Due</h6>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <h3 class="f-w-300 d-flex align-items-center m-b-0">0</h3>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <p class="m-b-0"><i class="fas fa-long-arrow-alt-right"></i> Result</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[ year  sales section ] end-->
                                <!--[ Recent Users ] start-->
                               <!--  <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Receive And Expenses Chart</h5>
                                        </div>
                                        <div class="card-block">
                                            <div id="morris-line-chart" class="ChartShadow" style="height:300px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-6">
                                    <div class="card Recent-Users">
                                        <div class="card-header">
                                            <h5>All Customer</h5>
                                        </div>
                                        <div class="card-block px-0 py-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Isabella Christensen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>11 MAY 12:56</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Mathilde Andersen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-red f-10 m-r-15"></i>11 MAY 10:35</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Karla Sorensen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>9 MAY 17:38</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Ida Jorgensen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply text of…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted f-w-300"><i class="fas fa-circle text-c-red f-10 m-r-15"></i>19 MAY 12:56</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                        <tr class="unread">
                                                            <td><img class="rounded-circle" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user"></td>
                                                            <td>
                                                                <h6 class="mb-1">Albert Andersen</h6>
                                                                <p class="m-0">Lorem Ipsum is simply dummy…</p>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>21 July 12:56</h6>
                                                            </td>
                                                            <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!--[ Recent Users ] end-->

                                <!-- [ statistics year chart ] start -->
                               <!--  <div class="col-xl-4 col-md-6">
                                    <div class="card">
                                        <div class="card-block border-bottom">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-credit-card f-30 text-c-red"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">235</h3>
                                                    <span class="d-block text-uppercase">Total Supplier</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block border-bottom">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-message-square f-30 text-c-purple"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">235</h3>
                                                    <span class="d-block text-uppercase">Total Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block border-bottom">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-alert-circle f-30 text-c-green"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">235</h3>
                                                    <span class="d-block text-uppercase">Total Staff</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto">
                                                    <i class="feather icon-clipboard f-30 text-c-blue"></i>
                                                </div>
                                                <div class="col">
                                                    <h3 class="f-w-300">26</h3>
                                                    <span class="d-block text-uppercase">Total Contractor</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12 m-b-30">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Today Sell</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Today Receive</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Today Expenses</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#register" role="tab" aria-controls="contact" aria-selected="false">Today Balance</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Activity</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">3:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Jumps over the lazy</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">2:37 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-red">Missed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Dog the quick brown</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">10:23 AM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple">Delayed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">4:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Activity</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Jumps over the lazy</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">2:37 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-red">Missed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">3:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">4:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Dog the quick brown</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">10:23 AM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple">Delayed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Activity</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Dog the quick brown</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">10:23 AM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple">Delayed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">3:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Jumps over the lazy</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">2:37 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-red">Missed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">4:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="contact-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Activity</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Dog the quick brown</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">10:23 AM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple">Delayed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">3:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Jumps over the lazy</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">2:37 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-red">Missed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">4:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="contest" role="tabpanel" aria-labelledby="contact-tab">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Activity</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th class="text-right"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Dog the quick brown</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">10:23 AM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-purple">Delayed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">3:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">Jumps over the lazy</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">2:37 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-red">Missed</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">The quick brown fox</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">4:28 PM</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0 text-c-green">Done</h6>
                                                        </td>
                                                        <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endsection



