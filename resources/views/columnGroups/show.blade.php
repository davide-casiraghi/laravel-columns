@extends('laravel-columns::columnGroups.layout')

@section('content')

    @include('laravel-columns::show-column-group', [
             'columnGroup' => $columnGroup,
             'columnGroupParameters' => $columnGroupParameters,
       ])
       
@endsection
