<?php

namespace Tests\Feature\Backend\Permission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Auth\Permission;


class UpdatePermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @test
     */
    public function an_admin_can_access_the_permission_role_page(){

        $permission = factory(Permission::class)->create();
        $this->loginAsAdmin();

        $this->get("/admin/auth/permission/{$permission->id}/edit")->assertStatus(200);

    }



    /** @test */
    public function a_permission_name_can_be_updated()
    {
        \Session::start();
        $permission = factory(Permission::class)->create();
        $this->loginAsAdmin();

        $this->patch("/admin/auth/permission/{$permission->id}", ['name' => 'new name', 'guard_name' => 'web','_token' => csrf_token()]);

        $this->assertEquals('new name', $permission->fresh()->name);
    }
}
