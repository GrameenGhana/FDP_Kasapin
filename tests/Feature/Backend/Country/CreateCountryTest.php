<?php

namespace Tests\Feature\Backend\Country;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCountryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function an_admin_can_access_the_create_country_page()
    {
        $this->loginAsAdmin();

        $this->get("/admin/auth/country/create")->assertStatus(200);

    }

    /**
     * @test
     */
    public function an_admin_can_access_the_index_country_page()
    {
        $this->loginAsAdmin();

        $this->get("/admin/auth/country/index")->assertStatus(200);



    }
}
