<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/17/18
 * Time: 11:31 AM
 */

namespace App\Models\Auth\Traits\Method;


trait CountryMethod
{
    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->name === config('access.users.admin_role');
    }
}
