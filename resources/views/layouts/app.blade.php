@extends('layouts.base')

@section('content')
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection

@section('scripts')
    @yield('scripts')
@endsection
