@extends('layouts.app',['title' => 'Dashboard'])

@section('content')

<div class="breadcrumb">
                <h1 class="mr-2">Status of Chair and Table</h1>
                <ul class="ml-auto">
                    <li><a href="{{url('/home')}}"><i class="i-Home1"></i>&nbsp;Dashboard</a></li>
                </ul>
            </div>
<div class="separator-breadcrumb border-top"></div>
<!-- Nak edit HTML, boleh edit di resources/js/components/Usergroup.vue-->
<statustable-component></statustable-component>

<!-- -- -->
@endsection

