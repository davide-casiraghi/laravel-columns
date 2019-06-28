<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use DavideCasiraghi\LaravelColumns\Facades\LaravelColumns;

class LaravelColumnsTest extends TestCase
{
    /** @test */
    public function it_gets_multiple_columns_snippet_occurances()
    {
        $text = 'Lorem ipsum {# column_group column_group_id=[6] #} sid amet.
                 Lorem ipsum {# column_group column_group_id=[8] #}.
        ';
        $matches = LaravelColumns::getColumnGroupSnippetOccurrences($text);
        //dd($matches);

        $this->assertEquals($matches[0][2], 6);
        $this->assertEquals($matches[1][2], 8);
    }

    /** @test */
    public function it_gets_no_columns_snippet_occurances()
    {
        $text = 'Lorem ipsum  sid amet. ';
        $matches = LaravelColumns::getColumnGroupSnippetOccurrences($text);

        $this->assertSame($matches, null);
    }

    /** @test */
    public function it_gets_the_column_parameter_array()
    {
        $column = factory(Column::class)->create([
            'icon_color' => '#FF00FF',
        ]);

        /*$id = Card::insertGetId([
            'image_file_name' => 'test image name',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        CardTranslation::insert([
            'card_id' => $id,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);*/

        $column = Column::where('id', 1)->first();
        $parameters = LaravelColumns::getParametersArray($column);

        //dd($parameters);

        $this->assertEquals($parameters['icon_color'], 'color: #FF00FF;');
        //$this->assertEquals($parameters['img_col_size_class'], 'col-md-3');
    }

    /** @test */
    public function it_gets_the_column_data()
    {
        $column = factory(Column::class)->create([
            'id' => 6,
            'title' => 'test title',
        ]);

        $columnData = LaravelColumns::getColumn($column['id']);
        $this->assertEquals($columnData['title'], 'test title');
    }

    /** @test */
    public function it_replace_column_group_snippets_with_template()
    {
        $columnGroup1 = factory(ColumnGroup::class)->create();
        $columnGroup2 = factory(ColumnGroup::class)->create();

        $column_1 = factory(Column::class)->create([
            'columns_group' => 1,
        ]);

        $column_2 = factory(Column::class)->create([
            'columns_group' => 1,
        ]);

        $column_3 = factory(Column::class)->create([
            'columns_group' => 1,
        ]);

        $column_4 = factory(Column::class)->create([
            'columns_group' => 2,
        ]);

        $column_5 = factory(Column::class)->create([
            'id' => 5,
            'columns_group' => 2,
        ]);

        $column_6 = factory(Column::class)->create([
            'columns_group' => 2,
            'body' => 'body test column 6'
        ]);

        $text = 'Lorem ipsum {# column_group column_group_id=['.$columnGroup1->id.'] #} sid amet.
                 Lorem ipsum {# column_group column_group_id=['.$columnGroup2->id.'] #}.
        ';

        $text = LaravelColumns::replace_column_group_snippets_with_template($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        
        $this->assertContains("body test column 6", $text);
    }

    /** @test */
    public function it_replace_a_column_group_string_with_alert_if_column_group_not_found()
    {
        $text = 'Lorem ipsum {# column_group column_group_id=[1] #}.';

        $text = LaravelColumns::replace_column_group_snippets_with_template($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        $this->assertContains("<div class='alert alert-warning' role='alert'>The column group with the specified id has not been found.</div>", $text);
    }
}
