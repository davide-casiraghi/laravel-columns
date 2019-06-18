@extends('laravel-columns::columns.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Add new column</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('columns.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    {{-- Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => old('title'),
                            'required' => true,
                        ])
                    </div>

                    {{-- Body --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' => 'Body',
                            'name' => 'body',
                            'value' => old('body'),
                            'required' => false,
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
                              'selected' => old('columns_group'),
                              'tooltip' => 'Pick the group to show',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Flex  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Flex',
                            'name' => 'column_flex',
                            'placeholder' => '', 
                            'value' => old('column_flex'),
                            'required' => true,
                            'tooltip' => 'The flex property applied to the specific column. Eg. 1 0 320px (grow shrink basis) or 0 1 auto',
                        ])
                    </div>
                
                    {{-- Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Column image',
                          'name' => 'image_file_name',
                          'folder' => 'columns',
                          'value' => old('image_file_name'),
                    ]) 
                    
                    {{-- Icons fontawesome --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons fontawesome',
                            'name' => 'fontawesome_icon_class',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => 'user-alt', 
                            'value' => old('fontawesome_icon_class'),
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Icon color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icon color',
                            'name' => 'icon_color',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => old('icon_color'),
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
                            'value' => old('button_url'),
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- ====================================================== --}}
                                                            
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'columns.index'  
                       ])
                    </div>
                                
                </div>
            </form>
    
    </div>
    
@endsection
