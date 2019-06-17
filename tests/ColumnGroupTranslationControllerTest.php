<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation;

class ColumnTranslationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_the_column_group_translation_create_page()
    {
        $this->authenticateAsAdmin();

        $columnGroupId = 1;
        $languageCode = 'es';

        $this->get('/columnGroupTranslations/'.$columnGroupId.'/'.$languageCode.'/create')
            ->assertViewIs('laravel-columns::columnGroupTranslations.create')
            ->assertStatus(200);
    }
    
    /** @test */
    public function it_stores_a_valid_column_group_translation()
    {
        $this->authenticateAsAdmin();
        
        $columnGroup = factory(ColumnGroup::class)->create();

        $data = [
            'column_group_id' => $columnGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish column group title',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/columnGroupTranslations/store', $data);
        
        $this->assertDatabaseHas('column_group_translations', ['locale' => 'es', 'title' => 'Spanish column group title']);
        $response->assertViewIs('laravel-columns::columnGroups.index');
    }
    
    /** @test */
    public function it_does_not_store_invalid_column_group_translation()
    {
        $this->authenticateAsAdmin();
        $response = $this
            ->followingRedirects()
            ->post('/columnGroupTranslations/store', []);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_displays_the_event_column_translation_edit_page()
    {
        $this->authenticateAsAdmin();
        $columnGroup = factory(ColumnGroup::class)->create();

        $data = [
            'column_group_id' => $columnGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish column group title',
        ];

        $this->post('/columnGroupTranslations/store', $data);

        $response = $this->get('/columnGroupTranslations/'.$columnGroup->id.'/'.'es'.'/edit');
        $response->assertViewIs('laravel-columns::columnGroupTranslations.edit')
                 ->assertStatus(200);
    }

    /** @test */
    /*public function it_updates_valid_column_translation()
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
        
        $this->post('/columnTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'column_translation_id' => 2,
            'language_code' => 'es',
            'title' => 'Spanish column title updated',
          ]);
        $response = $this->followingRedirects()
                         ->put('/columnTranslations/update', $attributes);
        $response->assertViewIs('laravel-columns::columns.index')
                 ->assertStatus(200);
        $this->assertDatabaseHas('column_translations', ['locale' => 'es', 'title' => 'Spanish column title updated']);
    }*/
    
    /** @test */
    /*public function it_does_not_update_invalid_column_translation()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create();

        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];

        $this->post('/columnTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'column_translation_id' => 2,
            'language_code' => 'es',
            'name' => '',
          ]);
        $response = $this->followingRedirects()
                         ->put('/columnTranslations/update', $attributes);
        $response->assertSessionHasErrors();
    }*/
    
    /** @test */
    /*public function it_deletes_column_translation()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create();

        $data = [
            'column_id' => $column->id,
            'language_code' => 'es',
            'title' => 'Spanish column title',
        ];
        
        $this->post('/columnTranslations/store', $data);

        $response = $this->delete('/columnTranslations/destroy/2');
        $response->assertRedirect('/columns');
    }*/
}
