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
        $column = factory(Column::class)->create([
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
    public function it_updates_valid_column()
    {
        $this->authenticateAsAdmin();
        $column = factory(Column::class)->create();

        $attributes = ([
            'title' => 'test title updated',
            'body' => 'test body updated',
          ]);

        $response = $this->followingRedirects()
                         ->put('/columns/'.$column->id, $attributes);
        $response->assertViewIs('laravel-columns::columns.index')
                 ->assertStatus(200);
    }
    
    /** @test */
    public function it_does_not_update_invalid_column()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();
        $response = $this->put('/columns/'.$column->id, []);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_column()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();

        $response = $this->delete('/columns/'.$column->id);
        $response->assertRedirect('/columns');
    }
}
