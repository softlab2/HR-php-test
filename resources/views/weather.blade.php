@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        @asyncWidget('weather', ['reload'=>10])
    </div>
    <div class="col-md-4">
        @widget('weather', ['ajaxTimeout'=>10])
    </div>
</div>
@endsection