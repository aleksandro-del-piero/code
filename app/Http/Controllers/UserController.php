<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\ViewModels\UsersListViewForm;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(UserRepository $userRepository, Request $request)
    {
        if ($request->ajax()) {
            return (new UsersListViewForm($userRepository->getForPageListUsers()))
                ->getJsonUsers();
        }

        return view(
            'users.index',
            new UsersListViewForm(
                $userRepository->getForPageListUsers()
            )
        );
    }
}
