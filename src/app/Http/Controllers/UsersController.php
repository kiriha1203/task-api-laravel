<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Request;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Throwable;

class UsersController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/users",
     * tags={"user"},
     * summary="getIndex",
     *      @OA\Response(
     *      response="200",
     *      description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="users",
     *                      type="array",
     *                      @OA\Items(
     *                          ref="#/components/schemas/User"
     *                      ),
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Users get index successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to get the users index"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index()
    {
        try {
            $users = User::get();

            return new ApiSuccessResponse(
                ['users' => $users],
                ['message' => 'Users get index successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to get the users index',
                $exception
            );
        }
    }

    /**
     * @OA\Post(
     * path="/api/user",
     * tags={"user"},
     * summary="create",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"name", "email"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="テスト太郎",
     *                  description="name",
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="test@example.com",
     *                  description="email",
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="user",
     *                      ref="#/components/schemas/User"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User was created successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to create the user"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function create(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                "email" => $request->email,
            ]);

            return new ApiSuccessResponse(
                ['user' => $user],
                ['message' => 'User was created successfully'],
                Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to create the user',
                $exception
            );
        }
    }

    /**
     * @OA\Get(
     * path="/api/user",
     * tags={"user"},
     * summary="fetch",
     *      @OA\Parameter(
     *          in="query",
     *          name="user_id",
     *          required=true,
     *          description="user id",
     *          example="1",
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="user",
     *                      ref="#/components/schemas/User"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User get successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to create the user"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function fetch(Request $request)
    {
        try {
            $user = User::find($request->user_id);

            return new ApiSuccessResponse(
                ['user' => $user],
                ['message' => 'User get successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to get the user',
                $exception
            );
        }
    }

    /**
     * @OA\Put(
     * path="/api/user",
     * tags={"user"},
     * summary="update",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"user_id", "name"},
     *              @OA\Property(
     *                  property="user_id",
     *                  type="integer",
     *                  example="2",
     *                  description="user id",
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="変更太郎",
     *                  description="name",
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="user",
     *                      ref="#/components/schemas/User"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User update successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to update the user"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $user->update([
                'name' => $request->name,
            ]);

            return new ApiSuccessResponse(
                ['user' => $user],
                ['message' => 'User update successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to update the user',
                $exception
            );
        }
    }

    /**
     * @OA\Delete(
     * path="/api/user",
     * tags={"user"},
     * summary="delete",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"user_id"},
     *              @OA\Property(
     *                  property="user_id",
     *                  type="integer",
     *                  example="5",
     *                  description="user id",
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                    type="string",
     *                    nullable="true",
     *                    example="",
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User delete successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to delete the user"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $user->delete();

            return new ApiSuccessResponse(
                [],
                ['message' => 'User delete successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to delete the user',
                $exception
            );
        }
    }
}
