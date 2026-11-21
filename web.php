
// إدارة المستخدمين

Route::get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/users/edit/{id}', [UserController::class, 'edit']);

Route::put('/users/update/{id}', [UserController::class, 'update']);

Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);
