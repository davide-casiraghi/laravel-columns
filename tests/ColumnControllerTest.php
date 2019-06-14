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
    public function the_route_index_can_be_accessed()
    {
        $this->authenticateAsAdmin();
        $this->get('columns')
            ->assertViewIs('laravel-columns::columns.index')
            ->assertStatus(200);
    }

    /** @test */
    public function the_route_create_can_be_accessed()
    {
        $this->authenticateAsAdmin();

        $this->get('columns/create')
            ->assertViewIs('laravel-columns::columns.create')
            ->assertStatus(200);
    }

    /** @test */
    /*public function the_route_destroy_can_be_accessed()
    {
        $this->authenticateAsAdmin();

        $id = Column::insertGetId([
            'image_file_name' => 'image_test_1.jpg',
            'img_alignment' => 'right',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $this->delete('columns/1')
            ->assertStatus(302);
    }*/

    /** @test */
    /*public function the_route_update_can_be_accessed()
    {
        $this->authenticateAsAdmin();

        $id = Column::insertGetId([
            'image_file_name' => 'image_test_1.jpg',
            'img_alignment' => 'right',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $request = new \Illuminate\Http\Request();
        $request->replace([
              'title' => 'test title updated',
              'body' => 'test body updated',
          ]);

        $this->put('columns/1', [$request, 1])
            ->assertStatus(302);
    }*/

    /** @test */
    /*public function the_route_store_can_be_accessed()
    {
        $this->authenticateAsAdmin();

        $data = [
            'image_file_name' => 'test.jpg',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ];

        $this
            ->followingRedirects()
            ->post('/columns', $data);

        $this->assertDatabaseHas('columns', ['image_file_name' => 'test.jpg']);
    }*/

    /** @test */
    /*public function the_route_show_can_be_accessed()
    {
        $id = Column::insertGetId([
            'image_file_name' => 'image_test_1.jpg',
            'img_alignment' => 'right',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $this->get('columns/1')
            ->assertViewIs('laravel-columns::columns.show')
            ->assertViewHas('columnParameters')
            ->assertStatus(200);
    }*/

    /** @test */
    /*public function the_route_edit_can_be_accessed()
    {
        $this->authenticateAsAdmin();

        $id = Column::insertGetId([
            'image_file_name' => 'image_test_1.jpg',
            'img_alignment' => 'right',
            'button_url' => 'test button url',
            'img_col_size'  => '3',
            'bkg_color'  => '#FF00FF',
            'text_color'  => '#2365AA',
            'container_wrap'  => '1',
        ]);

        ColumnTranslation::insert([
            'column_id' => $id,
            'heading' => 'test heading',
            'title' => 'test title',
            'body' => 'test body',
            'button_text' => 'test button text',
            'locale' => 'en',
        ]);

        $this->get('columns/1/edit')
            ->assertViewIs('laravel-columns::columns.edit')
            ->assertViewHas('column')
            ->assertStatus(200);
    }*/
}
