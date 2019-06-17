<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnTranslation;

class ColumnTranslationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function the_route_create_translation_can_be_accessed()
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

        $this->get('columns-translation/'.$id.'/es/create')
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

        $this->delete('columns-translation/'.$id)
            ->assertStatus(302);
    }

    /** @test */
    public function the_route_update_can_be_accessed()
    {
        $this->authenticateAsAdmin();
        $eventCategory = factory(EventCategory::class)->create([
                            'name' => 'Regular Jams',
                            'slug' => 'regular-jams',
                        ]);

        $data = [
            'event_category_id' => $eventCategory->id,
            'language_code' => 'es',
            'name' => 'Spanish category name',
        ];

        $this->post('/eventCategoryTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'event_category_translation_id' => 2,
            'language_code' => 'es',
            'name' => 'Spanish category name updated',
          ]);
        $response = $this->followingRedirects()
                         ->put('/eventCategoryTranslations/update', $attributes);
        $response->assertViewIs('laravel-events-calendar::eventCategories.index')
                 ->assertStatus(200);
        $this->assertDatabaseHas('column_translations', ['locale' => 'es', 'name' => 'Spanish category name updated']);
        
        
        
        
        
        
        
        
        
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

        $translationId = ColumnTranslation::insert([
            'column_id' => $id,
            'title' => 'test title es',
            'body' => 'test body es',
            'button_text' => 'test button text es',
            'image_alt' => 'test alt text es',
            'locale' => 'es',
        ]);

        $request = new \Illuminate\Http\Request();
        $request->replace([
            'column_translation_id' => $translationId,
            'column_id' => $id,
            'body' => 'test spanish text updated',
            'language_code' => 'es',
         ]);

        $this->put('columns-translation/'.$translationId, [$request, $translationId])
                 ->assertStatus(302);

        //$this->assertDatabaseHas('column_translations', ['text' => 'test spanish text updated']);
    }
}
