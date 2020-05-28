@extends('layouts.app',['title' => 'Check Availability'])

@section('content')

<div class="breadcrumb">
                <h1 class="mr-2">Check Available</h1>
            </div>
<div class="separator-breadcrumb border-top"></div>
<!-- Nak edit HTML, boleh edit di resources/js/components/Usergroup.vue-->
<checkavail-component></checkavail-component>

<!-- -- -->
@endsection