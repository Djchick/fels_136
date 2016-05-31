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
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        $user = $this->userRepository->all();
        $this->viewData['user'] = $user;
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
            'editUser'    => $editUser, 
            'currentUser' => $currentUser,
        ];
        return view('user.edit', $this->viewData);
    }

    public function update(UserRequest $request, $id) {
        $input = $request->only(['name', 'email']);
        $updateUser = $this->userRepository->find($id);
        $updateUser->update($input);
        return redirect()->route('user.edit', $id)->withMessage(trans('user/messages.update_complete'));
    }

    public function destroy($id) {
        $user = $this->userRepository->find($id);
        $user->delete($id);
        return redirect()->route('user.index')->withMessage(trans('user/messages.delete_complete'));
    }

    public function getChangePassword() {
        return view('user.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request) {
        $user = Auth::user();
        $update = $this->userRepository->changePassword([
            'userId'   => $user->id,
            'password' => $request->get("new_password"),
        ]);
        if(! $update) {
           return redirect()->route('home')->withErrors(trans('user/messages.wellcome_login'));
        }
        return redirect()->back()->withMessage(trans('user/messages.update_complete'));
    }
}