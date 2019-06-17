

@if ($columnGroup)
    <div class="row flexColumns">
        
        <h3 style='{{$columnGroupParameters['title_style']}}'>{{$columnGroup['title']}}</h3>
        
        <div class='wrapper' style='{{$columnGroupParameters['wrapper_style']}}'>
        
            {{-- Columns --}}
    		@for ($i=0; $i < $columnGroup->column_number; $i++)
                <aside class='aside-{{$i}}' style=''>
                    @if ($column->icon)
                        
                    @endif
            @endfor	    	
                        
                        
        {{--
        
        @if ($columnGroupParameters['container_wrap'])
            <div class="container">
                <div class="row">
        @endif
        
        <div class="text {{$columnGroupParameters['text_col_size_class']}} my-auto px-4 {{$columnGroupParameters['text_col_order_class']}}">
            <h2 class="laravel-card-heading mt-5">{{$columnGroup['title']}}</h2>
            <div class="lead mb-4">{!!$columnGroup['body']!!}</div>
        </div>

        @if ($columnGroup['image_file_name'])
            <div class="image d-none d-md-block {{$columnGroupParameters['img_col_size_class']}} {{$columnGroupParameters['img_col_order_class']}}"
                    style="background-image: url(/storage/images/cards/{{$columnGroup['image_file_name']}});">
            </div>

            <div class="image col-12 d-md-none {{$columnGroupParameters['img_col_order_class']}}">
                <img class="laravel-card-image img-fluid mx-auto" src="/storage/images/cards/{{$columnGroup['image_file_name']}}" alt="{{$columnGroup['image_alt']}}">
            </div>
        @endif
        
        
        @if ($columnGroupParameters['container_wrap'])
                </div>
            </div>
        @endif
        --}}
    </div>
    
@else
    <div class="alert alert-warning" role="alert">The column group with the specified id has not been found.</div>
@endif
