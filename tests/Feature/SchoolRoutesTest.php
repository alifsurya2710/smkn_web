<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolRoutesTest extends TestCase
{
    /** @test */
    public function home_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SMKN WEB');
    }

    /** @test */
    public function jurusan_detail_is_accessible()
    {
        $response = $this->get('/school/jurusan/teknik-kendaraan-ringan');
        $response->assertStatus(200);
        $response->assertSee('Teknik Kendaraan Ringan');
    }

    /** @test */
    public function generic_content_is_accessible()
    {
        $response = $this->get('/school/profile/sejarah-singkat');
        $response->assertStatus(200);
        $response->assertSee('Sejarah Singkat');
        $response->assertSee('Konten Segera Hadir');
    }
}
