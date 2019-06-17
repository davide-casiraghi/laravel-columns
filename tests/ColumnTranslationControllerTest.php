<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnTranslation;

class ColumnTranslationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_the_column_translation_create_page()
    {
        $this->authenticateAsAdmin();

        $columnId = 1;
        $languageCode = 'es';

        $this->get('/columns-translation/'.$columnId.'/'.$languageCode.'/create')
            ->assertViewIs('laravel-columns::columnsTranslations.create')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_edit_translation_can_be_accessed()
    {
        $id = Column::insertGetId([
            'columns_group' => 1,
            'image_file_name' => 'image_test_1.jpg',
            'fontawesome_icon_class' => 'fa-hand-heart',
            'icon_color' => '#2365AA',
            'button_url' => 'http://www.google.it',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'image_alt' => 'test alt text',
            'locale' => 'en',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'title' => 'test title es',
            'body' => 'test body es',
            'button_text' => 'test button text es',
            'image_alt' => 'test alt text es',
            'locale' => 'es',
        ]);

        $this->get('columns-translation/'.$id.'/es/edit')
            ->assertViewIs('laravel-columns::columnsTranslations.edit')
            ->assertViewHas('columnId')
            ->assertViewHas('languageCode')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_store_translation_can_be_accessed()
    {
        $id = Column::insertGetId([
            'columns_group' => 1,
            'image_file_name' => 'image_test_1.jpg',
            'fontawesome_icon_class' => 'fa-hand-heart',
            'icon_color' => '#2365AA',
            'button_url' => 'http://www.google.it',
        ]);

        $data = [
            'column_id' => $id,
            'language_code' => 'es',
            'title' => 'test title spanish',
            'body' => 'test body spanish',
            'button_text' => 'test button text spanish',
        ];

        $this
            ->followingRedirects()
            ->post('/columns-translation', $data);

        $this->assertDatabaseHas('columns', ['image_file_name' => 'image_test_1.jpg']);
    }

    /** @test */
    public function the_route_destroy_can_be_accessed()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create();

        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];
        
        $this->post('/columns-translation/store', $data);

        $response = $this->delete('/columns-translation/destroy/2');
        $response->assertRedirect('/columns');
    }

    /** @test */
    public function the_route_update_can_be_accessed()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create([
                            'title' => 'Column 1',
                        ]);
        
        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];
        
        $this->post('/columns-translation/store', $data);

        // Update the translation
        $attributes = ([
            'column_translation_id' => 2,
            'language_code' => 'es',
            'title' => 'Spanish column title updated',
          ]);
        $response = $this->followingRedirects()
                         ->put('/columns-translation/update', $attributes);
        $response->assertViewIs('laravel-columns::columns.index')
                 ->assertStatus(200);
        $this->assertDatabaseHas('column_translations', ['locale' => 'es', 'title' => 'Spanish column title updated']);
    }
}
