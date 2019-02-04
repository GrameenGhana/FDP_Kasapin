<?php

namespace App\Http\Requests\Backend\Auth\Permission;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Auth\Permission;

class DeletePermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_permission_can_be_deleted()
    {
        \Session::start();
        $permission = factory(Permission::class)->create();
        $this->loginAsAdmin();

        $this->assertDatabaseHas(config('permission.table_names.permissions'), ['id' => $permission->id]);

        $this->delete("/admin/auth/role/{$permission->id}",['_token' => csrf_token()]);

        $this->assertDatabaseMissing(config('permission.table_names.permissions'), ['id' => $permission->id]);
    }

}
