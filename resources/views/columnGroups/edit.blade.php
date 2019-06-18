@extends('laravel-columns::columnGroups.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Edit column group</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('columnGroups.update', $columnGroup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    
                    {{-- Background color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Background color',
                            'name' => 'bkg_color',
                            'tooltip' => 'Exadecimal value for the background color. Active if a value is specified.',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->bkg_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Text alignment --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Text alignment",
                              'name' => 'text_alignment',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'left' => 'Left',
                                 'center' => 'Center',
                                 'right' => 'Right',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->text_alignment,
                              'required' => false,
                              'tooltip' => '',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    {{-- Group Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => $columnGroup->title,
                            'required' => true,
                        ])
                    </div>

                    {{-- Group Description --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' => 'Description',
                            'name' => 'description',
                            'value' => $columnGroup->description,
                            'required' => false,
                        ])
                    </div>
            
                    {{-- ====================================================== --}}
                    
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Styles</h4>
                    </div>
                    
                    <h5 class="mt-4 mb-4">Group</h5>
                    
                    {{-- Group title color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Group title color',
                            'name' => 'group_title_color',
                            'tooltip' => 'Exadecimal value for the group title color.',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->group_title_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Group title font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Group titles font size',
                            'name' => 'group_title_font_size',
                            'tooltip' => 'Group font size (rem)',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->group_title_font_size,
                            'required' => false,
                        ])
                    </div>
                    
                    <h5 class="mt-4 mb-4">Column</h5>
                    
                    {{-- Column title color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Column title color',
                            'name' => 'column_title_color',
                            'tooltip' => 'Exadecimal value for the group title color.',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->column_title_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Column title font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Column titles font size',
                            'name' => 'column_title_font_size',
                            'tooltip' => 'Column font size (rem)',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->column_title_font_size,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Column descriptions font size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Descriptions font size',
                            'name' => 'description_font_size',
                            'tooltip' => 'Description font size (rem)',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->description_font_size,
                            'required' => false,
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Link options</h4>
                    </div>
                    
                    {{-- Link Style --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Link Style",
                              'name' => 'link_style',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '1' => 'Text',
                                 '2' => 'Button',
                                 '3' => 'Button Ghost',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->link_style,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                    
                    {{-- Button url --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button url',
                            'name' => 'button_url',
                            'placeholder' => 'https://...', 
                            'value' => $columnGroup->button_url,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button text --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button text',
                            'name' => 'button_text',
                            'placeholder' => '', 
                            'value' => $columnGroup->button_text,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Button color",
                              'name' => 'button_color',
                              'placeholder' => "choose one...", 
                              'records' => $buttonColorArray,
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->button_color,
                              'tooltip' => 'Check the press-css.io website for the preview of the color available.',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Button Corners --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Button Corners",
                              'name' => 'button_corners',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '1' => 'Square',
                                 '2' => 'Half Round',
                                 '3' => 'Round',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->button_corners,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Wrapper background</h4>
                    </div>
                    
                    {{-- Background type --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Background type",
                              'name' => 'background_type',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '0' => 'None',
                                 '1' => 'Colored',
                                 '2' => 'Gradient',
                                 '3' => 'Image',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->background_type,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Black cover percentage",
                              'name' => 'opacity',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '0' => 'None',
                                 '1' => '10%',
                                 '2' => '20%',
                                 '3' => '30%',
                                 '4' => '40%',
                                 '5' => '50%',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->opacity,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- Background Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Background Image', 
                          'name' => 'background_image',
                          'folder' => 'column_groups_background_images',
                          'value' => $columnGroup->background_image,
                          'required' => false,
                    ])
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Background image position",
                              'name' => 'background_image_position',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 '0' => 'None',
                                 '1' => '10%',
                                 '2' => '20%',
                                 '3' => '30%',
                                 '4' => '40%',
                                 '5' => '50%',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->background_image_position,
                              'required' => false,
                              'tooltip' => 'aaa',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Flex wrapper parameters</h4>
                    </div>
                
                    {{-- Black cover percentage --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Justify content",
                              'name' => 'justify_content',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'flex-start' => 'flex-start',
                                 'flex-end' => 'flex-end',
                                 'center' => 'center',
                                 'space-around' => 'space-around',
                                 'space-between' => 'space-between',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->justify_content,
                              'required' => false,
                              'tooltip' => '- flex-start: all the elements aligned on the left. - flex-end: elements aligned at the end; - center: aligned at the center; - space-around: split all the available space in a way that there is the same space on the left and on the right of each element; - space-between: equal space between the elements, no space in the beginning and in the end.',
                        ])
                    </div>
                
                    {{-- Flex wrap --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Flex wrap",
                              'name' => 'flex_wrap',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'nowrap' => 'nowrap',
                                 'wrap' => 'wrap',
                                 'wrap-reverse' => 'wrap-reverse',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->flex_wrap,
                              'required' => false,
                              'tooltip' => '- flex-start: all the elements aligned on the left. - flex-end: elements aligned at the end; - center: aligned at the center; - space-around: split all the available space in a way that there is the same space on the left and on the right of each element; - space-between: equal space between the elements, no space in the beginning and in the end.',
                        ])
                    </div>
                
                    {{-- Flex flow --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Flex flow",
                              'name' => 'flex_flow',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'row' => 'row',
                                 'column' => 'column',
                                 'column-reverse' => 'column-reverse',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->flex_flow,
                              'required' => false,
                              'tooltip' => '- row-reverse: it will show the element in horizontal way starting from right. - column: switch the main axis from horizontal to vertical showing elements starting from top. - column-reverse: switch the main axis from horizontal to vertical showing elements starting from bottom.',
                        ])
                    </div>
                
                    {{-- ====================================================== --}}
                
                    <div class="col-12">
                        <hr>
                        <h4 class="mt-4 mb-4">Column's parameters</h4>
                    </div>
                
                    {{-- Flex  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Flex',
                            'name' => 'columns_flex',
                            'placeholder' => '', 
                            'value' => $columnGroup->columns_flex,
                            'required' => true,
                            'tooltip' => 'The flex property applied to all columns. Can be overrided by setting the flex property of the single cild. Eg. flex: 1 0 320px (grow shrink basis) or 0 1 auto',
                        ])
                    </div>
                    
                    {{-- Padding  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Padding',
                            'name' => 'columns_padding',
                            'placeholder' => '', 
                            'value' => $columnGroup->columns_padding,
                            'required' => true,
                            'tooltip' => 'eg. 10px 30px 10px 30px',
                        ])
                    </div>
                    
                    {{-- Box sizing --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Box sizing",
                              'name' => 'columns_box_sizing',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'content-box' => 'content-box',
                                 'border-box' => 'border-box',
                              ],
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $columnGroup->columns_box_sizing,
                              'required' => false,
                              'tooltip' => '- row-reverse: it will show the element in horizontal way starting from right. - column: switch the main axis from horizontal to vertical showing elements starting from top. - column-reverse: switch the main axis from horizontal to vertical showing elements starting from bottom.',
                        ])
                    </div>
                    
                    {{-- Round images --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'columns_round_images',
                              'description' => 'Round images',
                              'value' => $columnGroup->columns_round_images,
                              'required' => false,
                        ])
                    </div>
                
                    {{-- Images width  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Images width',
                            'name' => 'columns_images_width',
                            'placeholder' => '', 
                            'value' => $columnGroup->columns_images_width,
                            'required' => true,
                            'tooltip' => 'eg. 30px',
                        ])
                    </div>
                
                    {{-- Hide images on mobile --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'columns_images_hide_mobile',
                              'description' => 'Hide images on mobile',
                              'value' => $columnGroup->columns_images_hide_mobile,
                              'required' => false,
                        ])
                    </div>
                
                    {{-- Font awesome icon size --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Font awesome icon size. ',
                            'name' => 'icons_size',
                            'placeholder' => '2rem', 
                            'value' => $columnGroup->icons_size,
                            'required' => true,
                            'tooltip' => 'eg. 2rem',
                        ])
                    </div>
                
                    {{-- Icons color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons color',
                            'name' => 'icon_color',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => $columnGroup->icon_color,
                            'required' => false,
                        ])
                    </div>
                                        
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'columnGroups.index'  
                       ])
                    </div>
                    
                </div>
            </form>
    
    </div>
    
@endsection
