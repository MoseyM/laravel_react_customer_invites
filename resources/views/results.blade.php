@extends('layouts.default')

@section('content')
    <div id="app" data={{ $data }}></div>
@endsection

@section('extra-js')
    <script src="/js/app.js"></script>
@endsection