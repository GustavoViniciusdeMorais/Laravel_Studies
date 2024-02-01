<?php

use Redninjaturtle\RedLaravelLocation\Http\Controllers\LocationsController;

Route::get('/locale/configs', [LocationsController::class, 'configs']);

Route::get('/locale/{local}', function ($locale) {
    request()->session()->put('locale', $locale);
    return redirect('/pages');
});
