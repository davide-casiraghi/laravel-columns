<?php

namespace DavideCasiraghi\LaravelColumns;

use DavideCasiraghi\LaravelColumns\Models\Column;

class LaravelColumns
{
    /**************************************************************************/

/**
 *  Provide the column data array (column_title, column_body, column_image).
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

    $ret['column_id'] = $matches[2];

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

    if ($matches) {
        foreach ($matches as $key => $single_gallery_matches) {
            $snippetParameters = self::getSnippetParameters($single_gallery_matches);
            //dd("aaa");
            $column = self::getColumn($snippetParameters['column_id']);
            //dd($column);
            $columnParameters = ($column) ? $this->getParametersArray($column) : null;

            $columnView = self::showColumnGroup($column, $columnParameters);
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
 * @return \Illuminate\Http\Response
 */
public function showColumnGroup($columnGroup, $columnGroupParameters)
{
    return view('laravel-columns::show-column-group', compact('columnGroup'))
        ->with('columnGroupParameters', $columnGroupParameters);
}

/***************************************************************************/

/**
 * Return an array with the parameters for the column.
 * @param  \DavideCasiraghi\LaravelColumns\Models\Column  $column
 * @return array
 */
public static function getParametersArray($column)
{
    $wrapper_style = "justify-content:".$column->justify_content."; ";
	$wrapper_style .= "flex-flow:".$column->flex_flow."; ";
	$wrapper_style .= "flex-wrap:".$column->flex_wrap."; ";
	$wrapper_style .= "text-align:".$column->text_alignment."; ";
            
    if ($column->background_type == 3){
        $wrapper_style  .= "background-image:".$column->background_image."; ";
        $wrapper_style  .= "background-position:".$column->background_image_position."; ";
    }
    
    $ret = [
        'icon_color' => 'color: '.$column->icon_color.';',
        'wrapper_style' => $wrapper_style,
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
