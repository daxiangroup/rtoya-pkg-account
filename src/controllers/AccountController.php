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
        $user = $this->userService
            ->retrieveUserById($id);

        $formData = $this->accountService
            ->formData($user);

        return View::make('account::edit-password')
            ->with('user',     $user)
            ->with('formData', $formData);
    }

    public function getEditSocial($id)
    {
        $user = $this->userService
            ->retrieveUserById($id);

        $formData = $this->accountService
            ->formData($user);

        return View::make('account::edit-social')
            ->with('user',     $user)
            ->with('formData', $formData);
    }

    public function postSave()
    {
        $user = $this->userService
            ->retrieveUserById(Auth::user()->id);

        $values = Input::get('values');

        $user = $this->accountService
            ->prepareSave($user, $values);

        $user->save();
        $user->push();

        return Redirect::route('account');
    }
}
