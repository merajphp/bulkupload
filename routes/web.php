<?php

use App\Http\Controllers\ContactController;

Route::redirect('/', '/contacts');
Route::resource('contacts', ContactController::class);
Route::post('contacts/import', [ContactController::class, 'import'])->name('contacts.import');
