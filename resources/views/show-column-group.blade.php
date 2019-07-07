

@if ($columnGroup)
    
    <div class='flexColumns py-4 px-2' style='{{$columnGroupParameters['container_style']}}'>
        
        <div class='group'>
            <h3 class='mb-4' style='{{$columnGroupParameters['group_title_style']}}'>{{$columnGroup['title']}}</h3>
            
            @if(!empty($columnGroup['description']))
                <div class="mb-3" style="{{$columnGroupParameters['group_description_style']}}">
                    {!!$columnGroup['description']!!}
                </div>
            @endif
            
            {{-- Button / Link --}}
            @if ($columnGroup->link_style == 2 && !empty($columnGroup->button_url))
                <div class="button mb-3" style="{{$columnGroupParameters['group_button_style']}}">
                    <button class='press {{$columnGroupParameters['button_class']}}' onclick='location.href="{{$columnGroup->button_url}}"'>
                        @if ($columnGroup->button_text)
                            {{$columnGroup->button_text}}
                        @else
                            Insert a button text please
                        @endif
                    </button>
                @elseif($columnGroup->link_style == 1)
                    <a href='{{$columnGroup->button_url}}'>
                        @if ($columnGroup->button_text)
                            {{$columnGroup->button_text}}
                        @else
                            Insert a button text please
                        @endif
                    </a>
                @endif	
            </div>
        </div>
        
        <div class='wrapper' style='{{$columnGroupParameters['wrapper_style']}}'>
        
            {{-- Columns --}}
    		@foreach ($columns as $key => $column)
                
                <aside class='aside-{{$key}}' style='flex: @if ($column->column_flex) {{$column->column_flex}} @else {{$columnGroup->columns_flex}} @endif; '>
                    
                    {{-- Font awesome icon --}}
                    @if ($column->fontawesome_icon_class)
                        <i class='fa {{$column->fontawesome_icon_class}}' style='color: {{$column->icon_color}}; font-size: {{$columnGroup->icons_size}};'></i>
                    @endif
                    
                    {{-- Image --}}
                    @if ($column->image_file_name)
                        <img style='{{$columnGroupParameters['image_style']}}' class='{{$columnGroupParameters['image_class']}}' src='/storage/images/columns/{{$column->image_file_name}}'/>
                    @endif
                    
                    {{-- Text --}}
                    <h4 style='{{$columnGroupParameters['title_style']}}'>{{$column->title}}</h4>
                    @if ($column->separator_color)
                        <div class='separator' style='background-color: {{$column->separator_color}} ;'></div>
                    @endif
                    <p style='{{$columnGroupParameters['description_style']}}'>{{$column->body}}</p>    
    
                    {{-- Button / Link --}}
                    @if ($columnGroup->link_style == 2)
                        <button class='press {{$columnGroupParameters['button_class']}}' onclick='location.href="{{$column->button_url}}"'>
                            @if ($column->button_text)
								{{$column->button_text}}
							@else
								Insert a button text please
                            @endif
                        </button>
                    @elseif($columnGroup->link_style == 1)
                        <a href='{{$column->button_url}}'>
                            @if ($column->button_text)
								{{$column->button_text}}
							@else
								Insert a button text please
                            @endif
                        </a>
                    @endif	
					    		
                </aside>    
                
            @endforeach	
            
            <div class='bg-overlay' style='{{$columnGroupParameters['bg_overlay_style']}}'></div>
        </div>              
                        
        {{--
        
        @if ($columnGroupParameters['container_wrap'])
            <div class='container'>
                <div class='row'>
        @endif
        
        <div class='text {{$columnGroupParameters['text_col_size_class']}} my-auto px-4 {{$columnGroupParameters['text_col_order_class']}}'>
            <h2 class='laravel-card-heading mt-5'>{{$columnGroup['title']}}</h2>
            <div class='lead mb-4'>{!!$columnGroup['body']!!}</div>
        </div>

        @if ($columnGroup['image_file_name'])
            <div class='image d-none d-md-block {{$columnGroupParameters['img_col_size_class']}} {{$columnGroupParameters['img_col_order_class']}}'
                    style='background-image: url(/storage/images/cards/{{$columnGroup['image_file_name']}});'>
            </div>

            <div class='image col-12 d-md-none {{$columnGroupParameters['img_col_order_class']}}'>
                <img class='laravel-card-image img-fluid mx-auto' src='/storage/images/cards/{{$columnGroup['image_file_name']}}' alt='{{$columnGroup['image_alt']}}'>
            </div>
        @endif
        
        
        @if ($columnGroupParameters['container_wrap'])
                </div>
            </div>
        @endif
        --}}
    </div>
    
@else
    <div class='alert alert-warning' role='alert'>The column group with the specified id has not been found.</div>
@endif
