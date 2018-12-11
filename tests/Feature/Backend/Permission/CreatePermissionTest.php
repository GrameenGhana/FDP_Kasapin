<?php

namespace Tests\Feature\Backend\Permission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Auth\Permission;


class CreatePermissionTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function an_admin_can_access_the_create_permission_page()
    {
         $this->loginAsAdmin();

         $this->get("/admin/auth/permission/create")->assertStatus(200);

    }

    /**
     * @test
     */
    public function an_admin_can_access_the_index_permission_page()
    {
        $this->loginAsAdmin();

        $this->get("/admin/auth/permission/index")->assertStatus(200);

    }

    /**
     * @test
     */

    public function a_permission_can_be_created()
    {
        \Session::start();
        $this->loginAsAdmin();


        $this->post('/admin/auth/permission', ['name' => 'view country','_token' => csrf_token()]);

       $permission = Permission::where(['name' => 'view country'])->first();
       $this->assertEquals('view country',$permission->name);

    }



}
