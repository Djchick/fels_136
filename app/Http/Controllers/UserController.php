<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    /**
     * The user repository instance.
     */

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request) {
        $users = $this->userRepository->get();
        $page = $request->get("page");
        $lastPage = $users->lastPage();
        if($page && $page > $lastPage) {
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $users = $this->userRepository->get();
        }
        $this->viewData['users'] = $users;
        return view('user.list', $this->viewData);
    }

    public function create() {
        return view('user.add');
    }

    public function store(RegisterRequest $request) {
        $input = $request->only(['name', 'email', 'password']);
        $user = $this->userRepository->create($input);
        return redirect()->route('user.index')->withMessage(trans('user/messages.create_complete'));
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $editUser = $this->userRepository->find($id);
        $currentUser = Auth::user();
        $this->viewData = [
            'editUser' => $editUser, 
            'currentUser' => $currentUser,
        ];
        return view('user.edit', $this->viewData);
    }

    public function update(UserRequest $request, $id) {
        $input = $request->only(['name', 'email', 'password']);
        $updateUser = $this->userRepository->find($id);
        $updateUser->update($input);
        return redirect()->route('admin.user.edit', $id)->withMessage(trans('user/messages.update_complete'));
    }

    public function destroy($id) {
        $user = $this->userRepository->find($id);
        $user->delete($id);
        return redirect()->route('user.index')->withMessage(trans('user/messages.delete_complete'));
    }

    public function getUpdateProfile() {
        $editUser = Auth::user();
        $this->viewData = [
            'editUser' => $editUser,
        ];
        return view('user.update_profile', $this->viewData);
    }

    public function postUpdateProfile(UserRequest $request) {
        $editUser = Auth::user();
        $updateUser = $this->userRepository->find($editUser->id);
        $update = $updateUser->update($request->only([
            'name',
            'email',
        ]));
        if($update) {
            return redirect()->route('user.getUpdateProfile')->withMessage(trans('user/messages.update_complete'));
        }
        return redirect()->route('user.getUpdateProfile')->withErrors(trans('user/messages.common_error'));
    }

    public function getChangePassword() {
        return view('user.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request) {
        $user = Auth::user();
        $update = $this->userRepository->changePassword([
            'userId' => $user->id,
            'password' => $request->get("new_password"),
        ]);
        if(! $update) {
           return redirect()->route('home')->withErrors(trans('user/messages.wellcome_login'));
        }
        return redirect()->back()->withMessage(trans('user/messages.update_complete'));
    }
}