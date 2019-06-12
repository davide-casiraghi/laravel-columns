@extends('laravel-columns::cards.layout')

@section('content')
    
    <div class="row py-4">
        <div class="col-12 col-sm-9">
            <h4>Add new column group translation</h4>
        </div>
        <div class="col-12 col-sm-3 text-right">
            <span class="badge badge-secondary">{{$selectedLocaleName}}</span>
        </div>
    </div>

    @include('laravel-form-partials::error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('laravel-column-groups-translation.store') }}" method="POST">
        @csrf

            @include('laravel-form-partials::input-hidden', [
                  'name' => 'column_group_id',
                  'value' => $columnGroupId,
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
                    'value' => old('title'),
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::textarea-plain', [
                    'title' =>  'Description',
                    'name' => 'description',
                    'value' => old('description'),
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Button text',
                    'name' => 'button_text',
                    'placeholder' => '', 
                    'value' => old('button_text'),
                    'required' => true,
                ])
            </div>
            
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Image alt',
                    'name' => 'image_alt',
                    'placeholder' => '', 
                    'value' => old('image_alt'),
                    'required' => true,
                ])
            </div>
                
        </div>

        @include('laravel-form-partials::buttons-back-submit', [
            'route' => 'laravel-cards.index'  
        ])

    </form>

@endsection
