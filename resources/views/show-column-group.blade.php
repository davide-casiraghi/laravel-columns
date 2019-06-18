

@if ($columnGroup)
    
    <div class="row flexColumns">
        
        <h3 style='{{$columnGroupParameters['title_style']}}'>{{$columnGroup['title']}}</h3>
        
        <div class='wrapper' style='{{$columnGroupParameters['wrapper_style']}}'>
        
            {{-- Columns --}}
    		@foreach ($columns as $key => $column)
                
                <aside class='aside-{{$key}}'>
                    
                    {{-- Font awesome icon --}}
                    @if ($column->fontawesome_icon_class)
                        <i class='fa fa-{{$column->fontawesome_icon_class}}' style='{{$column->icon_color}}'></i>
                    @endif
                    
                    {{-- Image --}}
                    @if ($column->image_file_name)
                        {{--<img style='".$image_style."' class='".$image_class."' src='".JURI::base().$articleImages['image_intro']->image_intro."'/>--}}
                    @endif
                    
                    {{-- Text --}}
                    <h4 style='".$title_style."'>{{$column->title}}</h4>
                    <div class='separator' style='".$separator_style."'></div>
                    
                    
                    
                    <p style='".$description_style."'>{{$column->body}}</p>
                    
    
                    {{-- Button --}}
					    				
					    		
					    		
                    
                </aside>    
                
            @endforeach	
                        
                        
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
