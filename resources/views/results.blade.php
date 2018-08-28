@extends('layouts.default')

@section('content')
    <div id="xyz">{{$data}}</div>
    <div id="app"></div>
@endsection

@section('extra-js')
    <script src="/js/app.js"></script>
@endsection