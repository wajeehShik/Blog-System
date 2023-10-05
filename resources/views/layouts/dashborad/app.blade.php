<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="plate deit">
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/brands.min.css" integrity="sha512-rQgMaFKZKIoTKfYInSVMH1dSM68mmPYshaohG8pK17b+guRbSiMl9dDbd3Sd96voXZeGerRIFFr2ewIiusEUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('dashbord_style/css/mainar.css')}}">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
    @stack('css')
</head>

<body class="app sidebar-mini">>
    <header class="app-header"><a class="app-header__logo" href="index.html">Plate diet</a>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <li class="app-search">
                <input class="app-search__input" type="search" placeholder="Search">
                <button class="app-search__button"><i class="fa fa-search"></i></button>
            </li>
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa fa-user fa-lg"></i> تعديل بيانات الشخصية</a></li>
                    <li>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button class="dropdown-item" href="{{ route('logout') }}"><i class="bx bx-log-out"></i>
                                <i class="fa fa-sign-out fa-lg"></i> تسجيل الخروج</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset('assets/users/'.auth()->user()->image)}}" alt="User Image" width="100px" height="100px" style="margin-right:47px"></div>

        <p style="    color: white;
    text-align: center;
    font-size: 31px;
    margin-top: -20px;">{{auth()->user()->name}}</p>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">لوحة التحكم</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">مقالات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{route('admin.posts.index')}}"><i class=" icon fa fa-circle-o"></i>مقالات</a></li>
                    <li><a class="treeview-item" href="{{route('admin.categories.index')}}"><i class="icon fa fa-circle-o"></i> اقسام</a></li>
                    <li><a class="treeview-item" href="{{route('admin.tags.index')}}"><i class="icon fa fa-circle-o"></i> وسوم</a></li>
                    <li><a class="treeview-item" href="{{route('admin.faqs.index')}}"><i class="icon fa fa-circle-o"></i> الاسئلة الشائعه</a></li>
                    <li><a class="treeview-item" href="{{--route('admin.services.index')--}}"><i class="icon fa fa-circle-o"></i> خدمات الموقع</a></li>
                </ul>
            </li>
            <li><a class="app-menu__item" href="{{route('home')}}" target="_blank"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">صفحة الموقع</span></a></li>

            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">المستخدمين</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('صلاحيات-عرض')
                    <li><a class="treeview-item" href="{{route('admin.roles.index')}}"><i class="icon fa fa-circle-o"></i> الصلاحيات</a></li>
                    @endcan
                    @can('مشرفين-عرض')
                    <li><a class="treeview-item" href="{{route('admin.supervisors.index')}}"><i class="icon fa fa-circle-o"></i> المشرفين</a></li>
                    @endcan

                    @can("users-index")
                    <li><a class="treeview-item" href="{{route('admin.users.index')}}"><i class="icon fa fa-circle-o"></i>المستخدمين</a></li>
                    @endcan
                </ul>
            </li>

            @can("طلبات التواصل")
            <li><a class="treeview-item" href="{{route('admin.contactus.index')}}"><i class="icon fa fa-circle-o"></i> تعليقات المستخدمين </a></li>
            @endcan
            @can('صفحات الثابتة-عرض')
            <li><a class="treeview-item" href="{{route('admin.pages.index')}}"><i class="icon fa fa-circle-o"></i> صفحات الموقع </a></li>
            @endcan
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                @yield('title')
            </div>
        </div>
        @yield('content')
    </main>
    @include('sweetalert::alert')
    @include('layouts.dashborad.footer')
    @stack('scripts')