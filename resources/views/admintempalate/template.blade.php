<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>بيكرى - لوحة تحكم المشرف </title>
    <link href={{asset("css/bootstrap.min.css")}} rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href={{asset("css/plugins/metisMenu/metisMenu.min.css")}} rel="stylesheet">

    <!-- Timeline CSS -->
    <link href={{asset("css/plugins/timeline.css")}} rel="stylesheet">

    <!-- Custom CSS -->
    <link href={{asset(("css/sb-admin-2.css"))}} rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href={{asset("css/plugins/morris.css")}} rel="stylesheet">

    <!-- Custom Fonts -->
    <link href={{asset("vendor/font-awesome-4.7.0/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">

    {{--vue element--}}
    <link rel="stylesheet" href="//unpkg.com/element-ui/lib/theme-chalk/index.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    @yield('page-style-level')
</head>

<body>


{{--side bar and header start--}}

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" id="template" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">@{{ titel }} </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a class="active" href="javascript:;"><i class="fa fa-dashboard fa-fw"></i> @{{
                            Dashboard }} </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-mobile fa-fw"></i> @{{ AppAdminPanel }}<span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL('/deletage')}}"> المندوبين  </a>
                            </li>
                            <li>
                                <a href="{{URL('/contacus')}}"> تواصل معنا </a>
                            </li>
                            <li>
                                <a href="{{URL('/about_policy')}}"> عن التطبيق والسياسات </a>
                            </li>
                            <li>
                                <a href="{{URL('/socialmedia')}}"> مواقع التواصل </a>
                            </li>
                            <li>
                                <a href="{{URL('/branches')}}"> الفروع </a>
                            </li>
                            <li>
                                <a href="{{URL('/category')}}"> الاقسام الرئيسية </a>
                            </li>
                            <li>
                                <a href="{{URL('/subcategory')}}"> الاقسام الفرعية </a>
                            </li>
                            <li>
                                <a href="{{URL('/item')}}"> المنتجات </a>
                            </li>
                            <li>
                                <a href="{{URL('/tartoption')}}"> تسجيل الادوار والاحجام للتارت </a>
                            </li>

                            <li>
                                <a href="{{URL('/ads')}}"> الاعلانات </a>
                            </li>
                            <li>
                                <a href="{{URL('/tartadds')}}"> اضافات التارت </a>
                            </li>
                            <li>
                                <a href="{{URL('/tcolor')}}"> الوان التارت </a>
                            </li>
                            <li>
                                <a href="{{URL('/tartsizepage')}}"> احجام التارت </a>
                            </li>
                            <li>
                                <a href="{{URL('/tfloor')}}"> ادوار التارت </a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-file-text fa-fw"></i> التقارير<span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL('/salesreport')}}"> تقارير المبيعات </a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
                <center>
                    Powered by <a href="http://alexforprog.com" target="_blank">AlexApps</a>
                </center>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    {{--side bar and header end--}}
    <div id="page-wrapper">
        @yield('content')
    </div>
</div>


<!-- jQuery Version 1.11.0 -->
<script src={{asset("js/jquery-1.11.0.js")}}></script>

{{--<!-- Bootstrap Core JavaScript -->--}}
<script src={{asset("js/bootstrap.min.js")}}></script>

{{--<!-- Metis Menu Plugin JavaScript -->--}}
<script src={{asset("js/metisMenu/metisMenu.min.js")}}></script>

{{--<!-- Morris Charts JavaScript -->--}}
<script src={{asset("js/raphael/raphael.min.js")}}></script>
<script src={{asset("js/morris/morris.min.js")}}></script>

{{--<!-- Custom Theme JavaScript -->--}}
<script src={{asset("js/sb-admin-2.js")}}></script>
{{--<!-- Custom scripts for this page-->--}}
<script src="{{asset("vendor/underscore-1.8.3/underscore-min.js")}}"></script>
<script src={{asset("vendor/vue/vue.js")}}></script>
{{--vue element js--}}
<script src="//unpkg.com/element-ui/lib/index.js"></script>
<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>
<script src="//unpkg.com/vue-data-tables@3.0.1/dist/data-tables.min.js"></script>
<script src="https://unpkg.com/vue-select@latest"></script>
<script src={{asset("vendor/HttpProvider/vue-resource.min.js")}}></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-google-maps/0.1.21/vue-google-maps.js"></script>--}}
<script src={{asset("AdminScript/template.js")}}></script>


@yield('page-script-level')


</body>
</html>
