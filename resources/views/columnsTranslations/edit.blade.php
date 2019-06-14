@extends('laravel-columns::columns.layout')

@section('content')
    
    <div class="row py-4">
        <div class="col-12 col-sm-9">
            <h4>Edit column translation</h4>
        </div>
        <div class="col-12 col-sm-3 text-right">
            <span class="badge badge-secondary">{{$selectedLocaleName}}</span>
        </div>
    </div>

    @include('laravel-form-partials::error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('laravel-columns-translation.update', $columnTranslation->id) }}" method="POST">
        @csrf
        @method('PUT')
            @include('laravel-form-partials::input-hidden', [
                  'name' => 'column_translation_id',
                  'value' => $columnTranslation->id,
            ])
            @include('laravel-form-partials::input-hidden', [
                  'name' => 'column_id',
                  'value' => $columnId,
            ])
            @include('laravel-form-partials::input-hidden', [
                  'name' => 'language_code',
                  'value' => $languageCode
            ])

         <div class="row">
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Title',
                    'name' => 'title',
                    'placeholder' => '', 
                    'value' => $columnTranslation->title,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::textarea-plain', [
                    'title' =>  'Body',
                    'name' => 'body',
                    'value' => $columnTranslation->body,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Button text',
                    'name' => 'button_text',
                    'placeholder' => '', 
                    'value' => $columnTranslation->button_text,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Image alt',
                    'name' => 'image_alt',
                    'placeholder' => '', 
                    'value' => $columnTranslation->image_alt,
                    'required' => true,
                ])
            </div>
        </div>
        
        <div class="row mt-2">  
            <div class="col-12 action">
                @include('laravel-form-partials::buttons-back-submit', [
                    'route' => 'laravel-columns.index'  
                ])
    </form>

                <form action="{{ route('laravel-columns-translation.destroy',$columnTranslation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link pl-0">Delete translation</button>
                </form>
            </div>
        </div>

@endsection        
        
