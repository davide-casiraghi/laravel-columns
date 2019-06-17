<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroupTranslation;

class ColumnGroupControllerTest extends TestCase
{
    use WithFaker;

    /***************************************************************/

    /** @test */
    public function it_runs_the_test_column_group_factory()
    {
        $eventCategory = factory(ColumnGroup::class)->create([
                            'title' => 'test title',
                        ]);
        $this->assertDatabaseHas('column_group_translations', [
                                'locale' => 'en',
                                'title' => 'test title',
                ]);
    }
    
    /** @test */
    public function it_displays_the_column_groups_index_page()
    {
        $this->authenticateAsAdmin();
        $this->get('columnGroups')
            ->assertViewIs('laravel-columns::columnGroups.index')
            ->assertStatus(200);
    }

    /** @test */
    public function it_displays_the_column_group_create_page()
    {
        $this->authenticateAsAdmin();

        $this->get('columnGroups/create')
            ->assertViewIs('laravel-columns::columnGroups.create')
            ->assertStatus(200);
    }
    
    /** @test */
    public function it_stores_a_valid_column_group()
    {
        $this->authenticateAsAdmin();

        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'button_text' => 'test button text',
            'image_alt' => 'test image alt',
            'number_of_columns_shown' => 3,
            'bkg_color' => '#2365AA',
            'group_title_color' => '#2365AA',
            'group_title_font_size' => '2rem',
            'column_title_color' => '#2365AA',
            'column_title_font_size' => '2rem',
            'description_font_size' => '2rem',
            'link_style' => 2,
            'button_url' => 'http://www.google.it',
            'button_color' => '#2365AA',
            'button_corners' => '2rem',
            'background_type' => '2rem',
            'opacity' => '2rem',
            'background_image' => 'test_bkg_image.jpg',
            'background_image_position' => 2,
            'justify_content' => '2rem',
            'flex_wrap' => '2rem',
            'flex_flow' => '2rem',
            'columns_flex' => '2rem',
            'columns_padding' => '10px',
            'columns_box_sizing' => '2rem',
            'columns_round_images' => 1,
            'columns_images_width' => '200px',
            'columns_images_hide_mobile' => 0,
            'icons_size' => '100px',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/columnGroups', $data)

        $this->assertDatabaseHas('column_groups', ['background_image' => 'test_bkg_image.jpg']);
        $response->assertViewIs('laravel-columns::columnGroups.index');
    }
    
    /** @test */
    /*public function it_does_not_store_invalid_column()
    {
        $this->authenticateAsAdmin();
        $response = $this->post('/columns', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Column::first());
    }*/
    
    /** @test */
    /*public function it_displays_the_column_show_page()
    {
        $this->authenticate();

        $column = factory(Column::class)->create();
        $response = $this->get('/columns/'.$column->id);
        $response->assertViewIs('laravel-columns::columns.show')
                 ->assertStatus(200);
    }*/
    
    /** @test */
    /*public function it_displays_the_column_edit_page()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();
        $response = $this->get("/columns/{$column->id}/edit");
        $response->assertViewIs('laravel-columns::columns.edit')
                 ->assertStatus(200);
    }*/

    /** @test */
    /*public function it_updates_valid_column()
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
    }*/
    
    /** @test */
    /*public function it_does_not_update_invalid_column()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();
        $response = $this->put('/columns/'.$column->id, []);
        $response->assertSessionHasErrors();
    }*/

    /** @test */
    /*public function it_deletes_column()
    {
        $this->authenticateAsAdmin();

        $column = factory(Column::class)->create();

        $response = $this->delete('/columns/'.$column->id);
        $response->assertRedirect('/columns');
    }*/
}
