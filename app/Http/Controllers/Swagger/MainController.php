<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      title="Hush omaded",
 *      version="1.0.0"
 * ),
 * @OA\PathItem(
 *     path="/api/"
 * ),
 * 
 *  @OA\Components(
 *      @OA\SecurityScheme(
 *          securityScheme="bearerAuth",
 *          type="http",
 *          scheme="bearer",
 *          bearerFormat="JWT",
 *      )
 * )
 */


class MainController extends Controller
{
    //
}
