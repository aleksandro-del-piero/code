<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreFormRequest;
use App\Http\Resources\Api\UserCollection;
use App\Http\Resources\Api\UserResource;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @param UserRepository $userRepository
     * @return UserCollection
     */
    public function index(UserRepository $userRepository)
    {
        return new UserCollection($userRepository->getWithPaginate());
    }

    /**
     * @param UserRepository $userRepository
     * @param $id
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function show(UserRepository $userRepository, $id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception("The user_id must be an integer.", 400);
            }

            $user = $userRepository->getOneModelForApiShow($id);

            if (is_null($user)) {
                throw new ModelNotFoundException('User not found');
            }

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                "success" => false,
                "message" => "The user with the requested identifier does not exist",
                "fails" => [
                    "user_id" => [
                        $exception->getMessage()
                    ]
                ]
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                "fails" => [
                    "user_id" => [
                        $exception->getMessage()
                    ]
                ]
            ], 404);
        }
    }

    /**
     * @param UserService $userService
     * @param UserStoreFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserService $userService, UserStoreFormRequest $request)
    {
        try {
            $user = $userService->registerByApi($request->getDto());

            return response()->json([
                "success" => true,
                "user_id" => $user->id,
                "message" => "New user successfully registered"
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
