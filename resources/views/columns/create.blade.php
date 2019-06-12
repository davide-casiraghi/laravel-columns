@extends('laravel-columns::cards.layout')

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

            <form action="{{ route('laravel-columns.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
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
                          'seleted' => old('columns_group'),
                          'tooltip' => 'Pick the group to show',
                          'required' => false,
                    ])
                </div>
            
                {{-- ====================================================== --}}
                    
                                        
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'laravel-columns.index'  
                       ])
                    </div>
                                
                </div>
            </form>
    
    </div>
    
@endsection
