@extends('laravel-columns::columns.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Edit column</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('columns.update', $column->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    
                    {{-- Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => $column->title
                        ])
                    </div>
                    
                    {{-- Body --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' =>  'Body',
                            'name' => 'body',
                            'value' => $column->body
                        ])
                    </div>
                    
                    {{-- Columns group --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Columns group",
                              'name' => 'columns_group',
                              'placeholder' => "choose one...", 
                              'records' => $columnGroupsArray,
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'seleted' => $column->columns_group,
                              'tooltip' => 'Pick the group to show',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Column image',
                          'name' => 'image_file_name',
                          'folder' => 'columns',
                          'value' => $column->image_file_name
                    ]) 
                    
                    {{-- Icons fontawesome --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons fontawesome',
                            'name' => 'icon_fontawesome',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => $column->icon_fontawesome,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Icons color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons color',
                            'name' => 'icons_color',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => $column->icons_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button Url --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button Url',
                            'name' => 'button_url',
                            'tooltip' => '',
                            'placeholder' => 'https://...', 
                            'value' => $column->button_url,
                            'required' => false,
                        ])
                    </div>
                    
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                            'route' => 'columns.index'  
                        ])
                    </div>
                </div>
            </form>
    
    </div>
    
@endsection
