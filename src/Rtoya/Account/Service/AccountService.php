<?php namespace Rtoya\Account\Service;

use \User;
use \Hash;

class AccountService
{
    const FIELD_NAME         = 'name';
    const FIELD_EMAIL        = 'email';
    const FIELD_PASSWORD     = 'password';
    const FIELD_NEWPASSWORD  = 'newpassword';
    const FIELD_WEBSITE_URL  = 'website_url';
    const FIELD_FACEBOOK_URL = 'facebook_url';
    const FIELD_TWITTER      = 'twitter';

    public function formData(User $user)
    {
        // echo "<PRE>";
        // print_r($user);
        // die();
        $data[self::FIELD_NAME]         = $user->name;
        $data[self::FIELD_EMAIL]        = $user->email;
        $data[self::FIELD_WEBSITE_URL]  = $user->meta->website_url;
        $data[self::FIELD_FACEBOOK_URL] = $user->meta->facebook_url;
        $data[self::FIELD_TWITTER]      = $user->meta->twitter;

        return $data;
    }

    public function prepareSave(User $user, Array $values)
    {
        $fieldsUser = array(
            self::FIELD_NAME,
            self::FIELD_EMAIL,
        );

        $fieldsUserMeta = array(
            self::FIELD_WEBSITE_URL,
            self::FIELD_FACEBOOK_URL,
            self::FIELD_TWITTER,
        );

        foreach ($fieldsUser as $field) {
            if (empty($values[$field]) === false) {
                $user->{$field} = $values[$field];
            }
        }

        $user->name_slug = slugify($user->{self::FIELD_NAME}, true, false);

        if (empty($values[self::FIELD_NEWPASSWORD]) === false) {
            $user->{self::FIELD_PASSWORD} = Hash::make($values[self::FIELD_NEWPASSWORD]);
        }

        foreach ($fieldsUserMeta as $field) {
            if (empty($values[$field]) === false) {
                $user->meta->{$field} = $values[$field];
            }
        }

        return $user;
    }
}
