<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Kelahiran;
use App\Models\OrangTua;
use App\Models\Ayah;
use App\Models\Balita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KelahiranControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the index view is accessible.
     */
    public function test_index_view_is_accessible()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kelahiran');
        $response->assertStatus(200);
        $response->assertViewIs('kelahiran.index');
    }

    /**
     * Test if the create view is accessible.
     */
    public function test_create_view_is_accessible()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kelahiran/create');
        $response->assertStatus(200);
        $response->assertViewIs('kelahiran.create');
    }

    /**
     * Test if a new Kelahiran can be stored.
     */
    public function test_store_new_kelahiran()
    {
        $user = User::factory()->create();
        $orangTua = OrangTua::factory()->create();
        $ayah = Ayah::factory()->create();
        $balita = Balita::factory()->create();

        $response = $this->actingAs($user)->post('/kelahiran', [
            'orang_tua_id' => $orangTua->id,
            'ayah_id' => $ayah->id,
            'balita_id' => $balita->id,
            'jumlah_lahiran' => 2,
            'jenis_kelamin' => 'Laki-laki',
            'tgl' => '2022-01-01',
            'status_ibu' => 'Sehat',
            'status_bayi' => 'Sehat',
        ]);

        $response->assertRedirect('/kelahiran');
        $this->assertDatabaseHas('kelahirans', [
            'jumlah_lahiran' => 2,
            'jenis_kelamin' => 'Laki-laki',
        ]);
    }

    /**
     * Test if the edit view is accessible.
     */
    public function test_edit_view_is_accessible()
    {
        $user = User::factory()->create();
        $kelahiran = Kelahiran::factory()->create();

        $response = $this->actingAs($user)->get("/kelahiran/{$kelahiran->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('kelahiran.edit');
    }

    /**
     * Test if a Kelahiran can be updated.
     */
    public function test_update_kelahiran()
    {
        $user = User::factory()->create();
        $kelahiran = Kelahiran::factory()->create();
        $orangTua = OrangTua::factory()->create();
        $ayah = Ayah::factory()->create();
        $balita = Balita::factory()->create();

        $response = $this->actingAs($user)->put("/kelahiran/{$kelahiran->id}", [
            'orang_tua_id' => $orangTua->id,
            'ayah_id' => $ayah->id,
            'balita_id' => $balita->id,
            'jumlah_lahiran' => 3,
            'jenis_kelamin' => 'Perempuan',
            'tgl' => '2022-01-02',
            'status_ibu' => 'Sehat',
            'status_bayi' => 'Sehat',
        ]);

        $response->assertRedirect('/kelahiran');
        $this->assertDatabaseHas('kelahirans', [
            'id' => $kelahiran->id,
            'jumlah_lahiran' => 3,
            'jenis_kelamin' => 'Perempuan',
        ]);
    }

    /**
     * Test if a Kelahiran can be deleted.
     */
    public function test_destroy_kelahiran()
    {
        $user = User::factory()->create();
        $kelahiran = Kelahiran::factory()->create();

        $response = $this->actingAs($user)->delete("/kelahiran/{$kelahiran->id}");
        $response->assertRedirect('/kelahiran');
        $this->assertDeleted($kelahiran);
    }
}
