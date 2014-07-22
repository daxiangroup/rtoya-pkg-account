<?php namespace Rtoya\Account\Service;

use \User;
use \Hash;

class AccountService
{
    const FIELD_NAME        = 'name';
    const FIELD_EMAIL       = 'email';
    const FIELD_PASSWORD    = 'password';
    const FIELD_NEWPASSWORD = 'newpassword';

    public function formData(User $user)
    {
        $data[self::FIELD_NAME]  = $user->name;
        $data[self::FIELD_EMAIL] = $user->email;

        return $data;
    }

    public function prepareSave(User $user, Array $values)
    {
        if (empty($values[self::FIELD_NAME]) === false) {
            $user->{self::FIELD_NAME} = $values[self::FIELD_NAME];
        }

        if (empty($values[self::FIELD_EMAIL]) === false) {
            $user->{self::FIELD_EMAIL} = $values[self::FIELD_EMAIL];
        }

        if (empty($values[self::FIELD_NEWPASSWORD]) === false) {
            $user->{self::FIELD_PASSWORD} = Hash::make($values[self::FIELD_NEWPASSWORD]);
        }

        return $user;
    }
}
