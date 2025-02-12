<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


/**
 * @OA\POST(
 *     path="/api/register",
 *     summary="Регистрация пользователя",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","surname","patronymic","password"},
 *             @OA\Property(property="name", type="string", example="Shahboz"),
 *             @OA\Property(property="surname", type="string", example="Qurbonov"),
 *             @OA\Property(property="patronymic", type="string", example="G`aybulloevich"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="avatar", type="string", example="http://example.com/shahboz.jpg"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Пользователь успешно зарегистрирован"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Неверные данные"
 *     )
 * ),
 *
 * @OA\POST(
 *     path="/api/login",
 *     summary="Авторизация пользователя",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"login", "password"},
 *             @OA\Property(property="login", type="string", example="000001"),
 *             @OA\Property(property="password", type="string", example="password123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный вход",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неверные учетные данные"
 *     )
 * ),
 *
 * @OA\GET(
 *     path="/api/user",
 *     summary="Получение информации о пользователе",
 *     tags={"Users"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Информация о пользователе",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Shahboz"),
 *             @OA\Property(property="surname", type="string", example="Qurbonov"),
 *             @OA\Property(property="patronymic", type="string", example="G`aybulloevich"),
 *             @OA\Property(property="login", type="string", example="000001"),
 *             @OA\Property(property="avatar", type="string", example="http://example.com/avatar.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Не авторизован"
 *     )
 * ),
 * 
 *
 * @OA\Get(
 *     path="/api/user/{name}",
 *     summary="Поиск пользователей по имени",
 *     description="Возвращает пользователей с указанным именем",
 *     operationId="getUserName",
 *     tags={"Users"},
 * security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="name",
 *         in="path",
 *         required=true,
 *         description="Имя пользователя",
 *         @OA\Schema(type="string", example="Али")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Пользователи найдены",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="name", type="string", example="Shahboz"),
 *                  @OA\Property(property="surname", type="string", example="Qurbonov"),
 *                  @OA\Property(property="patronymic", type="string", example="G`aybulloevich"),
 *                  @OA\Property(property="avatar", type="string", format="url", example="http://example.com/avatar.jpg")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Пользователи не найдены",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Users not found")
 *         )
 *     )
 * )
 * 
 * 
 * @OA\PUT(
 *     path="/api/user",
 *     summary="Обновление профиля пользователя",
 *     tags={"Users"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "avatar"},
 *              @OA\Property(property="name", type="string", example="Shahboz"),
 *              @OA\Property(property="surname", type="string", example="Qurbonov"),
 *              @OA\Property(property="patronymic", type="string", example="G`aybulloevich"),
 *              @OA\Property(property="avatar", type="string", example="http://example.com/avatar.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Профиль успешно обновлен",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Shahboz"),
 *             @OA\Property(property="surname", type="string", example="Qurbonov"),
 *             @OA\Property(property="patronymic", type="string", example="G`aybulloevich"),
 *             @OA\Property(property="login", type="string", example="000001"),
 *             @OA\Property(property="avatar", type="string", example="http://example.com/avatar.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Неверные данные"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Не авторизован"
 *     )
 * ),
 *
 * @OA\POST(
 *     path="/api/chats",
 *     summary="Создание чата",
 *     tags={"Chats"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"type"},
 *             @OA\Property(property="type", type="string", enum={"support", "private"}, example="private")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Чат успешно создан",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="type", type="string", enum={"support", "private"}, example="private")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Неверные данные"
 *     )
 * ),
 *
 * @OA\GET(
 *     path="/api/chats/{id}/messages",
 *     summary="Получение сообщений чата",
 *     tags={"Chats"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Сообщения чата",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="message", type="string", example="Привет!"),
 *                 @OA\Property(property="file_url", type="string", example="http://example.com/file.jpg"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-06T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Чат не найден"
 *     )
 * ),
 *
 * @OA\POST(
 *     path="/api/chats/{id}/messages",
 *     summary="Отправка сообщения в чат",
 *     tags={"Messages"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"message"},
 *             @OA\Property(property="message", type="string", example="Как дела?"),
 *             @OA\Property(property="file_url", type="string", example="http://example.com/image.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Сообщение успешно отправлено"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Чат не найден"
 *     )
 * )
 */

class AuthController extends Controller
{
    // Controller logic
}
