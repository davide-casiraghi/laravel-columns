<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnTranslation;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation;

use DavideCasiraghi\LaravelColumns\Facades\LaravelColumns;

class LaravelColumnsTest extends TestCase
{
    /** @test */
    public function it_gets_multiple_columns_snippet_occurances()
    {
        $text = 'Lorem ipsum {# column column_id=[6] #} sid amet.
                 Lorem ipsum {# column column_id=[8] #}.
        ';
        $matches = LaravelColumns::getColumnSnippetOccurrences($text);
        //dd($matches);

        $this->assertEquals($matches[0][2], 6);
        $this->assertEquals($matches[1][2], 8);
    }

    /** @test */
    public function it_gets_no_columns_snippet_occurances()
    {
        $text = 'Lorem ipsum  sid amet. ';
        $matches = LaravelColumns::getColumnSnippetOccurrences($text);

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
    /*public function it_replace_card_snippets_with_template()
    {
        $cardId_1 = Card::insertGetId([
            'image_file_name' => 'image_test_1.jpg',
            'img_alignment' => 'right',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        CardTranslation::insert([
            'card_id' => $cardId_1,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $cardId_2 = Card::insertGetId([
            'image_file_name' => 'image_test_2.jpg',
            'img_alignment' => 'left',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        CardTranslation::insert([
            'card_id' => $cardId_2,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $text = 'Lorem ipsum {# card card_id=['.$cardId_1.'] #} sid amet.
                 Lorem ipsum {# card card_id=['.$cardId_2.'] #}.
        ';

        $text = LaravelCards::replace_card_snippets_with_template($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        $this->assertContains('<div class="row laravel-card" style="background-color: #FF00FF; color: #2365AA;"> <div class="text col-md-9 my-auto px-4 order-md-1"> <h2 class="laravel-card-heading mt-5">test title</h2> <div class="lead mb-4">test body</div> </div> <div class="image d-none d-md-block col-md-3 order-md-2" style="background-image: url(/storage/images/cards/image_test_1.jpg);"> </div> <div class="image col-12 d-md-none order-md-2"> <img class="laravel-card-image img-fluid mx-auto" src="/storage/images/cards/image_test_1.jpg" alt=""> </div> </div>', $text);
        $this->assertContains('<div class="row laravel-card" style="background-color: #FF00FF; color: #2365AA;"> <div class="text col-md-9 my-auto px-4 order-md-2"> <h2 class="laravel-card-heading mt-5">test title</h2> <div class="lead mb-4">test body</div> </div> <div class="image d-none d-md-block col-md-3 order-md-1" style="background-image: url(/storage/images/cards/image_test_2.jpg);"> </div> <div class="image col-12 d-md-none order-md-1"> <img class="laravel-card-image img-fluid mx-auto" src="/storage/images/cards/image_test_2.jpg" alt=""> </div> </div>', $text);
    }*/

    /** @test */
    /*public function it_replace_a_card_string_with_alert_if_card_not_found()
    {
        $text = 'Lorem ipsum {# card card_id=[1] #}.';

        $text = LaravelCards::replace_card_snippets_with_template($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        $this->assertContains('<div class="alert alert-warning" role="alert">The card with the specified id has not been found.</div>', $text);
    }*/
}
