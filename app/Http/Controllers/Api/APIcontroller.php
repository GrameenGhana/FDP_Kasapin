<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

/**
 *  Class ApiController
 *
 * @package App\Http\Controllers
 * @SWG\Swagger(
 *     basePath= "/api/v1",
 *     host = "localhost:8000",
 *     schemes = {"http"},
 *     @SWG\Info(
 *       version = "2.0",
 *       title = "FDP Kasapin",
 *       description = "This API contains all allowable functionalities to be available internally to other resources & apps.You need to request a token to access this resource.",
 *       @SWG\Contact(
 *              email="jdavis@grameenfoundation.org"
 *          ),
 *         @SWG\License(
 *              name="Grameen Foundation",
 *              url="http://github.com/gruntjs/grunt/blob/master/LICENSE-MIT"
 *          ),
 *
 *     ),
 *
 *     @SWG\Definition(
 *
 *      definition = "Response",
 *      required = { "data"}
 *
 *    )
 *
 *  )
 *
 */

class APIcontroller extends Controller
{
    //
}
