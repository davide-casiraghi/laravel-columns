@extends('laravel-columns::columns.layout')

@section('content')
    {{--
    @if($column)
        {{$column->heading}}<br />
        {{$column->title}}<br />
        {{$column->body}}<br />
        {{$column->button_text}}<br />
        @if(!empty($column->image_file_name))
            <img class="ml-3 float-right img-fluid mb-2" src="/storage/images/columns/thumb_{{ $column->image_file_name }}" ><br />
        @endif
        {{$column->button_url}}<br />
    @else
        <div class="alert alert-warning" role="alert">
            No column corresponding to the specified ID has been found.
        </div>
    @endif
    --}}
    
    @include('laravel-columns::show-column', [
         'column' => $column,
         'columnParameters' => $columnParameters,
   ])
    
@endsection
