@extends('layouts.app')

@section('content')
<div class="breadcrumb">
                <h1 class="mr-2">Audit Trail</h1>
                <ul class="ml-auto">
                    <li><a href="./home"><i class="i-Home1"></i>&nbsp;Dashboard</a></li>
                    <li><a href="">Audit Trail</a></li>
                </ul>
            </div>
<div class="separator-breadcrumb border-top"></div>
<!-- Nak edit HTML, boleh edit di resources/js/components/Usergroup.vue-->
<audittrail-component></audittrail-component>

<!-- -- -->
@endsection