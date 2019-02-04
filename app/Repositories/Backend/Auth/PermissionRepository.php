<?php

namespace App\Repositories\Backend\Auth;

use App\Repositories\BaseRepository;
use App\Models\Auth\Permission;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * @param array $data
     *
     * @return Permission
     * @throws GeneralException
     */
    public function create(array $data) : Permission
    {
        // Make sure it doesn't already exist
        if ($this->permissionExists($data['name'])) {
            throw new GeneralException('A permission already exists with the name '.$data['name']);
        }


        return DB::transaction(function () use ($data) {
            $permission = parent::create(['name' => strtolower($data['name']),"guard_name" => 'web']);

            if($permission)
            {
                return $permission;
                //add permission created event  here
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Permission  $permission, array $data)
    {


        // If the name is changing make sure it doesn't already exist
        if ($permission->name !== strtolower($data['name'])) {
            if ($this->permissionExists($data['name'])) {
                throw new GeneralException('A permission already exists with the name '.$data['name']);
            }
        }


        return DB::transaction(function () use ($permission, $data) {
            if ($permission->update([
                'name' => strtolower($data['name']),
            ])) {

               // event(new RoleUpdated($permission));

                return $permission;
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.update_error'));
        });
    }



    /**
     * @param $name
     *
     * @return bool
     */
    protected function permissionExists($name) : bool
    {
        return $this->model
                ->where('name', strtolower($name))
                ->count() > 0;
    }
}
