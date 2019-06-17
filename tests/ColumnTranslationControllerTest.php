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
    public function it_stores_a_valid_column_translation()
    {
        $this->authenticateAsAdmin();
        
        $column = factory(Column::class)->create();

        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/columns-translation/store', $data);
        
        $this->assertDatabaseHas('column_translations', ['locale' => 'es', 'title' => 'Spanish column title']);
        $response->assertViewIs('laravel-columns::columns.index');
    }
    
    /** @test */
    public function it_does_not_store_invalid_column_translation()
    {
        $this->authenticateAsAdmin();
        $response = $this
            ->followingRedirects()
            ->post('/columns-translation/store', []);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_displays_the_event_column_translation_edit_page()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create();

        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];

        $this->post('/columns-translation/store', $data);

        $response = $this->get('/columns-translation/'.$column->id.'/'.'es'.'/edit');
        $response->assertViewIs('laravel-columns::columnsTranslations.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_column_translation()
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
    
    /** @test */
    public function it_does_not_update_invalid_column_translation()
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
            'name' => '',
          ]);
        $response = $this->followingRedirects()
                         ->put('/columns-translation/update', $attributes);
        $response->assertSessionHasErrors();
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

    
}
