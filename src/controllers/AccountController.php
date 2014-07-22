<?php namespace Rtoya\Account;

use \Auth;
use \BaseController;
use \Input;
use \Redirect;
use \User;
use \View;
use Rtoya\Account\Service\AccountService;
use Rtoya\Base\Service\UserService;

class AccountController extends BaseController {
    public function __construct(AccountService $accountService, UserService $userService)
    {
        $this->accountService = $accountService;
        $this->userService    = $userService;
    }

    public function getIndex()
    {
        return View::make('account::account')
            ->with('user', Auth::user());
    }

    public function getEditSettings($id)
    {
        if ($this->ensureSelf($id) === false) {
            return Redirect::route('account');
        }

        $user = $this->userService
            ->retrieveUserById($id);

        $formData = $this->accountService
            ->formData($user);

        return View::make('account::edit-settings')
            ->with('user',     $user)
            ->with('formData', $formData);
    }

    public function getEditPassword($id)
    {
        if ($this->ensureSelf($id) === false) {
            return Redirect::route('account');
        }

        $user = $this->userService
            ->retrieveUserById($id);

        $formData = $this->accountService
            ->formData($user);

        return View::make('account::edit-password')
            ->with('user',     $user)
            ->with('formData', $formData);
    }

    // public function getEditByName($name)
    // {
    //     $user = $this->userService
    //         ->retrieveUserByName($name);

    //     if (count($user) === 0) {
    //         return Redirect::route('account.edit.byId', Auth::user()->name);
    //     }

    //     return $this->getEditById($user->id);
    // }

    public function postSave()
    {
        $user = $this->userService
            ->retrieveUserById(Auth::user()->id);

        $values = Input::get('values');

        $user = $this->accountService
            ->prepareSave($user, $values);

        // echo '<pre>';
        // dd($user);
        $user->save();

        return Redirect::route('account');
    }

    private function ensureSelf($id)
    {
        return $id == Auth::user()->id;
    }
}
