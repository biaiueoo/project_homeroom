@extends('dashboard.master')
@section('title', 'Dashboard')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Dashboard')
@section('main')
    @include('dashboard.main')
    @include('dashboard.dashboard')
@endsection