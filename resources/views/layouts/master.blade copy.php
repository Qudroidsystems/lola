<!doctype html>
<html lang="en" class="fixed">


<!-- Mirrored from myiideveloper.com/helsinki/helsinki-blue/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Jan 2017 07:53:19 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Helsinki</title>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('asset/favicon/apple-icon-120x120.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('asset/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('asset/favicon/favicon-16x16.png')}}">
    <script src="{{ asset('asset/vendor/pace/pace.min.js')}}"></script>
    <link href="{{ asset('asset/vendor/pace/pace-theme-minimal.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/animate.css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/stylesheets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/data-table/media/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/data-table/extensions/Responsive/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/sweetalert/sweetalert.css')}}">

    <link rel="stylesheet" href="{{ asset('asset/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/vendor/select2/css/select2-bootstrap.min.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #loader {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          width: 100%;
          background: url(images/Fidget-spinner.gif) no-repeat center center;
          z-index: 10000;
        }
    </style>
</head>

<body>
<div class="wrap">
    <div class="page-header">
        <div class="leftside-header">
            <div class="logo">
                <a href="index.html" class="on-click">
                    <img alt="logo" src="{{ asset('asset/images/header-logo.png')}}" />
                </a>
            </div>
            <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
         </div>
        <div class="rightside-header">
            <div class="header-middle"></div>
            <div class="header-section" id="search-headerbox">
                <input type="text" name="search" id="search" placeholder="Search...">
                <i class="fa fa-search search" id="search-icon" aria-hidden="true"></i>
                <div class="header-separator"></div>
            </div>
            <div class="header-section hidden-xs" id="notice-headerbox">
                <div class="notice" id="checklist-notice">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    <div class="dropdown-box basic">
                        <div class="drop-header">
                            <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> To-Do List</h3>
                        </div>
                        <div class="drop-content">
                            <div class="widget-list list-to-do">
                                <ul>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-s1" value="option1">
                                            <label class="check" for="check-s1">Accusantium eveniet ipsam neque</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-s2" value="option1" checked>
                                            <label class="check" for="check-s2">Lorem ipsum dolor sit</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-s3" value="option1">
                                            <label class="check" for="check-s3">Dolor eligendi in ipsum sapiente</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-s4" value="option1">
                                            <label class="check" for="check-s4">Natus recusandae vel</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="check-s5" value="option1">
                                            <label class="check" for="check-s5">Adipisci amet officia tempore ut</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="drop-footer">
                            <a>See all Items</a>
                        </div>
                    </div>
                </div>
                <div class="notice" id="messages-notice">
                    <i class="fa fa-comments-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger"><i class="fa fa-exclamation"></i></span></i>
                    <div class="dropdown-box basic">
                        <div class="drop-header ">
                            <h3><i class="fa fa-comments-o" aria-hidden="true"></i> Messages</h3>
                            <span class="badge x-danger b-rounded">120</span>
                        </div>
                        <div class="drop-content">
                            <div class="widget-list list-left-element">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><img alt="John Doe" src="images/avatar_1.jpg" /></div>
                                            <div class="text">
                                                <span class="title">John Doe</span>
                                                <span class="subtitle">Lorem ipsum dolor sit.</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><img alt="Alice Smith" src="images/avatar_2.jpg" /></div>
                                            <div class="text">
                                                <span class="title">Alice Smith</span>
                                                <span class="subtitle">Deserunt, mollitia?</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><img alt="Klaus Wolf" src="images/avatar_3.jpg" /></div>
                                            <div class="text">
                                                <span class="title">Klaus Wolf</span>
                                                <span class="subtitle">Consectetur adipisicing elit.</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><img alt="Sun Li" src="images/avatar_4.jpg" /></div>
                                            <div class="text">
                                                <span class="title">Sun Li</span>
                                                <span class="subtitle">Tenetur tempora?</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><img alt="Sonia Valera" src="images/avatar_5.jpg" /></div>
                                            <div class="text">
                                                <span class="title">Sonia Valera</span>
                                                <span class="subtitle">Similique ad maxime.</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="drop-footer">
                            <a>See all messages</a>
                        </div>
                    </div>
                </div>
                <div class="notice" id="alerts-notice">
                    <i class="fa fa-bell-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger">7</span></i>
                    <div class="dropdown-box basic">
                        <div class="drop-header">
                            <h3><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</h3>
                            <span class="badge x-danger b-rounded">7</span>
                        </div>
                        <div class="drop-content">
                            <div class="widget-list list-left-element list-sm">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><i class="fa fa-warning color-warning"></i></div>
                                            <div class="text">
                                                <span class="title">8 Bugs</span>
                                                <span class="subtitle">reported today</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><i class="fa fa-flag color-danger"></i></div>
                                            <div class="text">
                                                <span class="title">Error</span>
                                                <span class="subtitle">sevidor C down</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><i class="fa fa-cog color-dark"></i></div>
                                            <div class="text">
                                                <span class="title">New Configuration</span>
                                                <span class="subtitle"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><i class="fa fa-tasks color-success"></i></div>
                                            <div class="text">
                                                <span class="title">14 Task</span>
                                                <span class="subtitle">completed</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="left-element"><i class="fa fa-envelope color-primary"></i></div>
                                            <div class="text">
                                                <span class="title">21 Menssage</span>
                                                <span class="subtitle"> (see more)</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="drop-footer">
                            <a>See all notifications</a>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
            </div>
            <div class="header-section" id="user-headerbox">
                <div class="user-header-wrap">
                    <div class="user-photo">
                        <img src="{{asset('asset/images/user-avatar.jpg')}}" alt="Jane Doe" />
                    </div>
                    <div class="user-info">
                        <span class="user-name"> {{ Auth::user()->name }}</span>
                        <span class="user-profile">Admin</span>
                    </div>
                    <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                    <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                </div>
                <div class="user-options dropdown-box">
                    <div class="drop-content basic">
                        <ul>
                            <li> <a href="pages_user-profile.html"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                            <li> <a href="pages_lock-screen.html"><i class="fa fa-lock" aria-hidden="true"></i> Lock Screen</a></li>
                            <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configurations</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-separator"></div>
            <div class="header-section">
              <a  href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out log-out" aria-hidden="true"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
        </div>
    </div>

<div class="page-body">
    @include('layouts.inc.leftbar')
    @yield('content')

      <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
     </div>
</div>

<script src="{{ asset('asset/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('asset/vendor/nano-scroller/nano-scroller.js')}}"></script>
<script src="{{ asset('asset/javascripts/template-script.min.js')}}"></script>
<script src="{{ asset('asset/javascripts/template-init.min.js')}}"></script>
<script src="{{ asset('asset/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('asset/vendor/chart-js/chart.min.js')}}"></script>
<script src="{{ asset('asset/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('asset/javascripts/examples/dashboard.html')}}"></script>
<script src="{{ asset('asset/vendor/data-table/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('asset/vendor/data-table/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('asset/vendor/data-table/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('asset/vendor/data-table/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{ asset('asset/javascripts/examples/tables/data-tables.js')}}"></script>
<script src="{{ asset('asset/vendor/bootstrap_max-lenght/bootstrap-maxlength.js')}}"></script>
<script src="{{ asset('asset/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('asset/vendor/input-masked/inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('asset/vendor/input-masked/phone-codes/phone.js')}}"></script>
<script src="{{ asset('asset/vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('asset/vendor/bootstrap_time-picker/js/bootstrap-timepicker.js')}}"></script>
<script src="{{ asset('asset/vendor/bootstrap_color-picker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('asset/javascripts/examples/forms/advanced.js')}}"></script>
<script src="{{ asset('asset/javascripts/examples/forms/advanced.js')}}"></script>
<script src="{{ asset('asset/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('asset/javascripts/examples/ui-elements/alerts.js')}}"></script>

</body>


<!-- Mirrored from myiideveloper.com/helsinki/helsinki-blue/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Jan 2017 07:54:24 GMT -->
</html>



