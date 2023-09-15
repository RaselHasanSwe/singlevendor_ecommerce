@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>98</h3>
                <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                <h3>1072</h3>
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>72</h3>
                <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>618</h3>
                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Patient Total</h4>
                    <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
                </div>
                <canvas id="linegraph"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Patients In</h4>
                    <div class="float-right">
                        <ul class="chat-user-total">
                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
                            <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
                        </ul>
                    </div>
                </div>
                <canvas id="bargraph"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="d-none">
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Timing</th>
                                <th class="text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="min-width: 200px;">
                                    <a class="avatar" href="profile.html">B</a>
                                    <h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Appointment With</h5>
                                    <p>Dr. Cristina Groves</p>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Timing</h5>
                                    <p>7.00 PM</p>
                                </td>
                                <td class="text-right">
                                    <a href="appointments.html" class="btn btn-outline-primary take-btn">Take up</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="min-width: 200px;">
                                    <a class="avatar" href="profile.html">B</a>
                                    <h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Appointment With</h5>
                                    <p>Dr. Cristina Groves</p>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Timing</h5>
                                    <p>7.00 PM</p>
                                </td>
                                <td class="text-right">
                                    <a href="appointments.html" class="btn btn-outline-primary take-btn">Take up</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="min-width: 200px;">
                                    <a class="avatar" href="profile.html">B</a>
                                    <h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Appointment With</h5>
                                    <p>Dr. Cristina Groves</p>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Timing</h5>
                                    <p>7.00 PM</p>
                                </td>
                                <td class="text-right">
                                    <a href="appointments.html" class="btn btn-outline-primary take-btn">Take up</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="min-width: 200px;">
                                    <a class="avatar" href="profile.html">B</a>
                                    <h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Appointment With</h5>
                                    <p>Dr. Cristina Groves</p>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Timing</h5>
                                    <p>7.00 PM</p>
                                </td>
                                <td class="text-right">
                                    <a href="appointments.html" class="btn btn-outline-primary take-btn">Take up</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="min-width: 200px;">
                                    <a class="avatar" href="profile.html">B</a>
                                    <h2><a href="profile.html">Bernardo Galaviz <span>New York, USA</span></a></h2>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Appointment With</h5>
                                    <p>Dr. Cristina Groves</p>
                                </td>
                                <td>
                                    <h5 class="time-title p-0">Timing</h5>
                                    <p>7.00 PM</p>
                                </td>
                                <td class="text-right">
                                    <a href="appointments.html" class="btn btn-outline-primary take-btn">Take up</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
        <div class="card member-panel">
            <div class="card-header bg-white">
                <h4 class="card-title mb-0">Doctors</h4>
            </div>
            <div class="card-body">
                <ul class="contact-list">
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">John Doe</span>
                                <span class="contact-date">MBBS, MD</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                <span class="contact-date">MD</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">John Doe</span>
                                <span class="contact-date">BMBS</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                <span class="contact-date">MS, MD</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">John Doe</span>
                                <span class="contact-date">MBBS</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                <span class="contact-date">MBBS, MD</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer text-center bg-white">
                <a href="doctors.html" class="text-muted">View all Doctors</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin_assets/assets/js/Chart.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/chart.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/app.js') }}"></script>
@endsection