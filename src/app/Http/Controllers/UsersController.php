<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use OpenApi\Annotations as OA;

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
     *                  property="users",
     *                  type="array",
     *                  @OA\Items(
     *                      ref="#/components/schemas/User"
     *                  ),
     *              ),
     *          ),
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index():Response
    {
        $users = User::get();

        return response()->success([
            'users' => $users
        ]);
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
     *      response="200",
     *      description="success",
     *          @OA\JsonContent(
     *                  ref="#/components/schemas/User"
     *              ),
     *          ),
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function create(Request $request):Response
    {
        $id, $name, $email = $request->input('id')

        $user = User::create([
            'name' => $request->name,
            "email" => $request->email,
        ]);

        return response()->json($user);
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
     *                  ref="#/components/schemas/User"
     *              ),
     *          ),
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function fetch(Request $request) {
        $user = User::find($request->user_id);

        return response()->json($user);
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
     *      response="200",
     *      description="success",
     *          @OA\JsonContent(
     *                  ref="#/components/schemas/User"
     *              ),
     *          ),
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request) {
        $user = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
        ]);

        return response()->json($user);
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
     *      response="200",
     *      description="success",
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     */

    public function delete(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();

        return response()->json();
    }
}
