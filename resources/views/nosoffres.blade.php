@extends('template')
 
@section('title', 'Nos offres')

@section('state_nosoffres', 'class=borderBottom')

@section('state_nosoffres_active', 'active')

@section('sidebar')
    @@parent
 
    <p>This is appended to the master sidebar.</p>
@endsection
 
@section('content')
    <p>This is my body content.</p>
@endsection