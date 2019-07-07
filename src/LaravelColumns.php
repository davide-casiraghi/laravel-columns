<?php

namespace DavideCasiraghi\LaravelColumns;

use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;

class LaravelColumns
{
    /**************************************************************************/

    /**
     *  Provide the column data array.
     *
     *  @param int $columnId
     *  @return  \DavideCasiraghi\LaravelColumns\Models\Column    $ret
     **/
    public static function getColumn($columnId)
    {
        $ret = Column::where('id', $columnId)->first();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Provide the columns of a specfied group.
     *
     *  @param int $columnId
     *  @return  \DavideCasiraghi\LaravelColumns\Models\Column    $ret
     **/
    public static function getColumnsByGroup($columnGroupId)
    {
        $ret = Column::where('columns_group', $columnGroupId)->get();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Provide the column group data array.
     *
     *  @param int $columnGroupId
     *  @return  \DavideCasiraghi\LaravelColumns\Models\ColumnGroup    $ret
     **/
    public static function getColumnGroup($columnGroupId)
    {
        $ret = ColumnGroup::where('id', $columnGroupId)->first();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Find the column snippet occurances in the text.
     *
     *  @param string $text
     *  @return array $matches
     **/
    public static function getColumnGroupSnippetOccurrences($text)
    {
        $re = '/{\#
            \h+column_group
            \h+(column_group_id)=\[([^]]*)]
            \h*\#}/x';

        if (preg_match_all($re, $text, $matches, PREG_SET_ORDER, 0)) {
            return $matches;
        } else {
            return;
        }
    }

    /**************************************************************************/

    /**
     *  Returns the plugin parameters.
     *
     *  @param array $matches
     *  @return array $ret
     **/
    public static function getSnippetParameters($matches)
    {
        $ret = [];

        // Get activation string parameters (from article)
        $ret['token'] = $matches[0];
        //dump($matches);

        $ret['column_group_id'] = $matches[2];

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Return the same text with the columns HTML replaced
     *  where the token strings has been found.
     *
     *  @param string $text
     *  @return string $ret
     **/
    public function replace_column_group_snippets_with_template($text)
    {
        $matches = self::getColumnGroupSnippetOccurrences($text);
        // aaaaaa

        if (! empty($matches)) {
            foreach ($matches as $key => $single_gallery_matches) {
                $snippetParameters = self::getSnippetParameters($single_gallery_matches);

                $columnGroupId = $snippetParameters['column_group_id'];

                $columnGroup = self::getColumnGroup($columnGroupId);
                $columnGroupParameters = ($columnGroup) ? (self::getParametersArray($columnGroup)) : null;
                $columns = self::getColumnsByGroup($columnGroupId);

                $columnView = self::showColumnGroup($columnGroup, $columnGroupParameters, $columns);
                $columnHtml = $columnView->render();

                // Substitute the column html to the token that has been found
                $text = str_replace($snippetParameters['token'], $columnHtml, $text);
            }
        }

        $ret = $text;

        return $ret;
    }

    /***************************************************************************/

    /**
     * Show a Column group.
     *
     * @param  \DavideCasiraghi\LaravelColumns\Models\ColumnGroup $columnGroup
     * @param array $columnGroupParameters
     * @param  \DavideCasiraghi\LaravelColumns\Models\Column $columns
     * @return \Illuminate\Http\Response
     */
    public function showColumnGroup($columnGroup, $columnGroupParameters, $columns)
    {
        return view('laravel-columns::show-column-group', compact('columnGroup'))
        ->with('columnGroupParameters', $columnGroupParameters)
        ->with('columns', $columns);
    }

    /***************************************************************************/

    /**
     * Return an array with the parameters for the column.
     * @param  \DavideCasiraghi\LaravelColumns\Models\ColumnGroup  $columnGroup
     * @return array
     */
    public static function getParametersArray($columnGroup)
    {
        $container_style = '';

        $group_title_style = 'text-align:'.$columnGroup->text_alignment.'; ';
        $group_title_style = 'color:'.$columnGroup->group_title_color.'; ';
        $group_title_style .= 'font-size:'.$columnGroup->group_title_font_size.'; ';

        $group_description_style = 'text-align:'.$columnGroup->text_alignment.'; ';
        $group_button_style = 'text-align:'.$columnGroup->text_alignment.'; ';

        /* Wrapper style */
        $wrapper_style = 'justify-content:'.$columnGroup->justify_content.'; ';
        $wrapper_style .= 'flex-flow:'.$columnGroup->flex_flow.'; ';
        $wrapper_style .= 'flex-wrap:'.$columnGroup->flex_wrap.'; ';
        $wrapper_style .= 'text-align:'.$columnGroup->text_alignment.'; ';

        switch ($columnGroup->background_type) {
            case 1:
                $container_style .= 'background-color: '.$columnGroup->bkg_color.';';
            break;
            case 2:
                // gradient
            break;
            case 3:
                $wrapper_style .= 'background-image:url(/storage/images/column_groups/'.$columnGroup->background_image.');';
                $wrapper_style .= 'background-position:'.$columnGroup->background_image_position.'; ';
            break;
            default:
                // code...
            break;
        }

        $bg_overlay_style = 'opacity: '.$columnGroup->opacity;

        /* Title style */
        $title_style = 'color:'.$columnGroup->column_title_color.'; ';
        $title_style .= 'font-size:'.$columnGroup->column_title_font_size.'; ';

        /* Description style */
        $description_style = 'font-size:'.$columnGroup->description_font_size.'; ';

        /* Button class*/
        $button_class = $columnGroup->button_color.'; ';
        $button_class .= $columnGroup->button_corners.'; ';
        if ($columnGroup->link_style == 3) {
            $button_class .= 'press-ghost; ';
        }

        // Image style and class
        $image_style = '';
        $image_style .= 'width:'.$columnGroup->columns_images_width.'; ';
        if ($columnGroup->columns_round_images) {
            $image_style .= 'border-radius: 50%;';
        }

        $image_class = '';
        if ($columnGroup->columns_images_hide_mobile) {
            $image_class .= 'hide-image-mobile';
        }

        $ret = [
            'container_style' => $container_style,
            'group_title_style' => $group_title_style,
            'group_description_style' => $group_description_style,
            'group_button_style' => $group_button_style,
            'wrapper_style' => $wrapper_style,
            'title_style' => $title_style,
            'description_style'  => $description_style,
            'image_style'  => $image_style,
            'image_class'  => $image_class,
            'button_class' => $button_class,
            'bg_overlay_style' => $bg_overlay_style,
        ];

        /*$ret = [
             'img_col_size_class' => 'col-md-'.$column->img_col_size,
             'text_col_size_class' => 'col-md-'.(12 - $column->img_col_size),
             'bkg_color' => 'background-color: '.$column->bkg_color.';',
             'text_color' => 'color: '.$column->text_color.';',
             'container_wrap' => ($column->container_wrap == 'true') ? 1 : 0,
         ];*/

        /*switch ($column->img_alignment) {
             case 'left':
                 $ret['img_col_order_class'] = 'order-md-1';
                 $ret['text_col_order_class'] = 'order-md-2';
                 break;
             case 'right':
                 $ret['img_col_order_class'] = 'order-md-2';
                 $ret['text_col_order_class'] = 'order-md-1';
                 break;
         }*/

        return $ret;
    }
}
