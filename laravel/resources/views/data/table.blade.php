@extends('layouts.app',['title' => 'List of Table'])

@section('content')

<div class="breadcrumb">
                <h1 class="mr-2">List of Table</h1>
                <ul class="ml-auto">
                    <li><a href="{{url('/home')}}"><i class="i-Home1"></i>&nbsp;Dashboard</a></li>
                     <li><a href="{{url('/tables')}}">List of Table</a></li>
                </ul>
            </div>
<div class="separator-breadcrumb border-top"></div>
<!-- Nak edit HTML, boleh edit di resources/js/components/Usergroup.vue-->
<table-component></table-component>

<!-- -- -->
@endsection