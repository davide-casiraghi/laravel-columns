<?php

namespace DavideCasiraghi\LaravelColumns\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelColumns\Models\ColumnGroup;

class ColumnGroupControllerTest extends TestCase
{
    use WithFaker;

    /***************************************************************/

    /** @test */
    public function it_runs_the_test_column_group_factory()
    {
        $columnGroup = factory(ColumnGroup::class)->create([
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
            ->post('/columnGroups', $data);

        $this->assertDatabaseHas('column_groups', ['background_image' => 'test_bkg_image.jpg']);
        $response->assertViewIs('laravel-columns::columnGroups.index');
    }

    /** @test */
    public function it_does_not_store_invalid_column_group()
    {
        $this->authenticateAsAdmin();
        $response = $this->post('/columnGroups', []);
        $response->assertSessionHasErrors();
        $this->assertNull(ColumnGroup::first());
    }

    /** @test */
    /*public function it_displays_the_column_group_show_page()
    {
        $this->authenticate();

        $columnGroup = factory(ColumnGroup::class)->create();
        $response = $this->get('/columnGroups/'.$columnGroup->id);
        $response->assertViewIs('laravel-columns::columnGroups.show')
                 ->assertStatus(200);
    }*/

    /** @test */
    public function it_displays_the_column_group_edit_page()
    {
        $this->authenticateAsAdmin();

        $columnGroup = factory(ColumnGroup::class)->create();
        $response = $this->get("/columnGroups/{$columnGroup->id}/edit");
        $response->assertViewIs('laravel-columns::columnGroups.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_column_group()
    {
        $this->authenticateAsAdmin();
        $columnGroup = factory(ColumnGroup::class)->create();

        $attributes = ([
            'title' => 'test title updated',
            'description' => 'test description updated',
          ]);

        $response = $this->followingRedirects()
                         ->put('/columnGroups/'.$columnGroup->id, $attributes);
        $response->assertViewIs('laravel-columns::columnGroups.index')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_does_not_update_invalid_column_group()
    {
        $this->authenticateAsAdmin();

        $columnGroup = factory(ColumnGroup::class)->create();
        $response = $this->put('/columnGroups/'.$columnGroup->id, []);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_column_group()
    {
        $this->authenticateAsAdmin();

        $columnGroup = factory(ColumnGroup::class)->create();

        $response = $this->delete('/columnGroups/'.$columnGroup->id);
        $response->assertRedirect('/columnGroups');
    }
}
