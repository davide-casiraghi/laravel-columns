@extends('laravel-columns::columnGroups.layout')

@section('content')

    @include('laravel-columns::show-column-group', [
            'columns' => $columns,
             'columnGroup' => $columnGroup,
             'columnGroupParameters' => $columnGroupParameters,
       ])
       
@endsection
