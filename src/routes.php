<?php

$controller = 'Rtoya\Account\AccountController@';

Route::group(array('before' => 'auth'), function() use ($controller)
{

    Route::get('/account', array(
        'uses' => $controller.'getIndex',
        'as'   => 'account'));

    Route::group(array('before' => 'isSelf'), function() use ($controller)
    {

        Route::get('/account/{id}/edit/settings', array(
            'uses' => $controller.'getEditSettings',
            'as'   => 'account.edit.settings'))
            ->where('id', '[0-9]+');

        Route::get('/account/{id}/edit/password', array(
            'uses' => $controller.'getEditPassword',
            'as'   => 'account.edit.password'))
            ->where('id', '[0-9]+');

        Route::get('/account/{id}/edit/social', array(
            'uses' => $controller.'getEditSocial',
            'as'   => 'account.edit.social'))
            ->where('id', '[0-9]+');

        Route::post('/account/{id}/edit/{any?}', array(
            'uses' => $controller.'postSave',
            'as'   => 'account.save'))
            ->where('id', '[0-9]+');

    });

});
