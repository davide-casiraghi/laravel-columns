<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\Column;
use DavideCasiraghi\LaravelColumns\Models\ColumnTranslation;

class ColumnControllerTest extends TestCase
{
    use WithFaker;

    /***************************************************************/

    /** @test */
    public function it_runs_the_test_column_factory()
    {
        $eventCategory = factory(Column::class)->create([
                            'title' => 'test title',
                        ]);
        $this->assertDatabaseHas('column_translations', [
                                'locale' => 'en',
                                'title' => 'test title',
                ]);
    }
    
    /** @test */
    public function it_displays_the_columns_index_page()
    {
        $this->authenticateAsAdmin();
        $this->get('columns')
            ->assertViewIs('laravel-columns::columns.index')
            ->assertStatus(200);
    }

    /** @test */
    public function it_displays_the_column_create_page()
    {
        $this->authenticateAsAdmin();

        $this->get('columns/create')
            ->assertViewIs('laravel-columns::columns.create')
            ->assertStatus(200);
    }
    
    /** @test */
    public function it_stores_a_valid_column()
    {
        $this->authenticateAsAdmin();

        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'columns_group' => 1,
            'image_file_name' => 'image_test_1.jpg',
            'fontawesome_icon_class' => 'fa-hand-heart',
            'icon_color' => '#2365AA',
            'button_url' => 'http://www.google.it',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/columns', $data);

        $this->assertDatabaseHas('columns', ['image_file_name' => 'image_test_1.jpg']);
        $response->assertViewIs('laravel-columns::columns.index');
    }
    
    /** @test */
    public function it_does_not_store_invalid_column()
    {
        $this->authenticateAsAdmin();
        $response = $this->post('/columns', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Column::first());
    }
    
    /** @test */
    public function it_displays_the_column_show_page()
    {
        $this->authenticate();

        $column = factory(Column::class)->create();
        $response = $this->get('/columns/'.$column->id);
        $response->assertViewIs('laravel-columns::columns.show')
                 ->assertStatus(200);
    }
    
    /** @test */
    public function it_displays_the_column_edit_page()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();
        $response = $this->get("/columns/{$column->id}/edit");
        $response->assertViewIs('laravel-columns::columns.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function the_route_destroy_can_be_accessed()
    {
        $this->authenticateAsAdmin();

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

        $this->delete('columns/1')
            ->assertStatus(302);
    }

    /** @test */
    public function the_route_update_can_be_accessed()
    {
        $this->authenticateAsAdmin();

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

        $request = new \Illuminate\Http\Request();
        $request->replace([
              'title' => 'test title updated',
              'body' => 'test body updated',
          ]);

        $this->put('columns/1', [$request, 1])
            ->assertStatus(302);
    }

    
}
