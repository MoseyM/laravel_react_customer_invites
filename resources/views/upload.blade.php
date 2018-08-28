@extends('layouts.default')

@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div className="col-md-8">
            <form action="{{url('/upload')}}" method="post" encType="multipart/form-data">
                @csrf
                Input: <input type="file" name="data-file" id="data-file" />
                <input type="submit" value="Submit" />
            </form>
        </div>
@endsection