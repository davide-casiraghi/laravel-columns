@extends('laravel-columns::columns.layout')

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-6">
            <h4>Column group list</h4>
        </div>
        <div class="col-12 col-sm-6 mt-4 mt-sm-0 text-right">
            <a class="btn btn-success create-new" href="{{ route('columnGroups.create') }}">Add new columns group</a>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    
    {{-- List all the quotes --}}
    <div class="quotesList my-4">
        
        {{--
        @foreach ($columns as $column)
            <div class="row bg-white shadow-1 rounded mb-3 pb-2 pt-3 mx-1">
                
                <div class="col-12 py-1">
                    <h5>{{ $column->author }}</h5>
                    <div class="">
                        {{ $column->text }}
                    </div>
                </div>
                
                <div class="col-12 pb-2">
                    <form action="{{ route('columns.destroy',$column->id) }}" method="POST">
                        <a class="btn btn-primary float-right" href="{{ route('columns.edit',$column->id) }}">Edit</a>
                        
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-link pl-0">Delete</button>
                    </form>
                </div>
                
            </div>
        @endforeach
        --}}
        
        
        @foreach ($columns as $column)
                <div class="row bg-white shadow-1 rounded mb-3 mx-1">
                    
                    <div class="col-12 pb-2 pt-3 px-3">
                        <div class="row">
                            
                            {{-- Title --}}
                            <div class="col-12 py-1 title">
                                <h5 class="darkest-gray">{{ $column->title }}</h5>
                            </div>
                            <div class="col-12">
                                @if($column->translate('en')->body){{ $column->translate('en')->body }}@endif
                            </div>
                            
                            {{-- Translations --}}
                            <div class="col-12 mb-4 mt-4">
                                @foreach ($countriesAvailableForTranslations as $key => $countryAvTrans)
                                    @if($column->hasTranslation($key))
                                        <a href="{{ route('laravel-columnGroupTranslations.edit', ['jumbotronImageTranslationId' => $column->id, 'languageCode' => $key]) }}" class="bg-success text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @else
                                        <a href="{{ route('laravel-columnGroupTranslations.create', ['jumbotronImageTranslationId' => $column->id, 'languageCode' => $key]) }}" class="bg-secondary text-white px-2 py-1 mb-1 mb-lg-0 d-inline-block rounded">{{$key}}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-12 pb-2 action">
                                <form action="{{ route('columnGroups.destroy',$column->id) }}" method="POST">

                                    <a class="btn btn-primary float-right" href="{{ route('columnGroups.edit',$column->id) }}">@lang('laravel-columns::general.edit')</a>
                                    <a class="btn btn-outline-primary mr-2 float-right" href="{{ route('columnGroups.show',$column->id) }}">@lang('laravel-columns::general.view')</a>
                                    
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-link pl-0">@lang('laravel-columns::general.delete')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            @endforeach    
        
        
        
                      
    </div>

@endsection
