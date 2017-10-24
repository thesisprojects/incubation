<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::name('getLogin')->get('/', 'AuthController@index');
        Route::name('postLogin')->post('/login', 'AuthController@authenticate')->middleware("throttle:5,1");
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::name('getLogout')->get('/logout', 'AuthController@unauthenticate');
        Route::name('getDashboard')->get('/dashboard', 'DashboardController@index');

        Route::group(['prefix' => 'roles/'], function () {
            Route::name('getRoles')->get('', 'RoleController@index')->middleware('permissions:view roles');
            Route::name('getEditRole')->get('edit/{roleID}', 'RoleController@edit')->middleware('permissions:edit roles');
            Route::name('postCreateRole')->post('create', 'RoleController@postCreate')->middleware('permissions:create roles');
            Route::group(['prefix' => 'api/'], function () {
                Route::name('postUpdateRole')->post('update', 'RoleController@postTogglePermissions')->middleware('permissions:edit roles');
            });
        });

        Route::group(['prefix' => 'users/'], function () {
            Route::name('getUsers')->get('', 'UserController@getUsers')->middleware('permissions:view users');
            Route::name('getEditUser')->get('edit/{id}', 'UserController@getEdit')->middleware('permissions:edit users');
            Route::name('postEditUser')->post('update', 'UserController@postUpdate')->middleware('permissions:edit users');
            Route::name('getCreateUser')->get('create', 'UserController@getCreate')->middleware('permissions:view users');
            Route::name('postCreateUser')->post('create', 'UserController@postCreate')->middleware('permissions:create users');
        });

        Route::group(['prefix' => 'farms/'], function () {
            Route::name('getFarms')->get('', 'FarmController@getFarms')->middleware('permissions:view farms');
            Route::name('getEditFarm')->get('edit/{id}', 'FarmController@getEdit')->middleware('permissions:edit farms');
            Route::name('postEditFarm')->post('update', 'FarmController@postUpdate')->middleware('permissions:edit farms');
            Route::name('getCreateFarm')->get('create', 'FarmController@getCreate')->middleware('permissions:view farms');
            Route::name('postCreateFarm')->post('create', 'FarmController@postCreate')->middleware('permissions:create farms');
        });

        Route::group(['prefix' => 'eggs/'], function () {
            Route::name('getEggs')->get('', 'EggsController@getEggs')->middleware('permissions:view eggs');
            Route::name('getEditEgg')->get('edit/{id}', 'EggsController@getEdit')->middleware('permissions:edit eggs');
            Route::name('postEditEgg')->post('update', 'EggsController@postUpdate')->middleware('permissions:edit eggs');
            Route::name('getCreateEgg')->get('create', 'EggsController@getCreate')->middleware('permissions:view eggs');
            Route::name('downloadExpiredEggsReport')->get('expired/download', 'ReportsController@downloadExpiredEggs')->middleware('permissions:view eggs');
            Route::name('downloadAlmostExpired')->get('almose/download', 'ReportsController@downloadAlmostExpired')->middleware('permissions:view eggs');
            Route::name('postCreateEgg')->post('create', 'EggsController@postCreate')->middleware('permissions:create eggs');
        });

        Route::group(['prefix' => 'incubators/'], function () {
            Route::name('getIncubators')->get('', 'IncubatorController@getIncubators')->middleware('permissions:view incubators');
            Route::name('getEditIncubator')->get('edit/{id}', 'IncubatorController@getEdit')->middleware('permissions:edit incubators');
            Route::name('postEditIncubator')->post('update', 'IncubatorController@postUpdate')->middleware('permissions:edit incubators');
            Route::name('getCreateIncubator')->get('create', 'IncubatorController@getCreate')->middleware('permissions:view incubators');
            Route::name('postCreateIncubator')->post('create', 'IncubatorController@postCreate')->middleware('permissions:create incubators');
            Route::name('getAssignEggs')->get('{id}/eggs', 'IncubatorController@getEggAssigningPage')->middleware('permissions:edit incubators');
            Route::name('postAddIncubatorEgg')->post('addeggtoincubator', 'IncubatorController@postEggAssigningPage')->middleware('permissions:edit incubators');
            Route::name('postRemoveEgg')->post('removeegg', 'IncubatorController@postRemoveEgg')->middleware('permissions:edit incubators');
            Route::name('postTransferEgg')->post('transferhatchery', 'IncubatorController@postTransferEgg')->middleware('permissions:edit incubators');
            Route::name('postBulkHatceryTransfer')->post('transferhatcherybulk', 'IncubatorController@postBulkHatceryTransfer')->middleware('permissions:edit incubators');
        });

        Route::group(['prefix' => 'clients/'], function () {
            Route::name('getClients')->get('', 'ClientController@getClients')->middleware('permissions:view client');
            Route::name('getCreateClient')->get('create', 'ClientController@getCreate')->middleware('permissions:create client');
            Route::name('getEditClient')->get('edit/{id}', 'ClientController@getEdit')->middleware('permissions:edit client');
            Route::name('postCreateClient')->post('create', 'ClientController@postCreate')->middleware('permissions:create client');
            Route::name('postEditClient')->post('update', 'ClientController@postUpdate')->middleware('permissions:edit client');
        });

        Route::group(['prefix' => 'hatchery/'], function () {
            Route::name('getHatcheries')->get('', 'HatcheryController@getHatcheries')->middleware('permissions:view hatchery');
            Route::name('getCreateHatchery')->get('create', 'HatcheryController@getCreate')->middleware('permissions:create hatchery');
            Route::name('getEditHatchery')->get('edit/{id}', 'HatcheryController@getEdit')->middleware('permissions:edit hatchery');
            Route::name('getHatcheryEggs')->get('{id}/eggs', 'HatcheryController@getHatcheryEggs')->middleware('permissions:view hatchery');
            Route::name('postCreateHatchery')->post('create', 'HatcheryController@postCreate')->middleware('permissions:create hatchery');
            Route::name('postEditHatchery')->post('update', 'HatcheryController@postUpdate')->middleware('permissions:edit hatchery');
        });

        Route::group(['prefix' => 'delivery/'], function () {
            Route::name('getDelivery')->get('', 'DeliveryController@index')->middleware('permissions:deliver');
            Route::name('postDeliver')->post('deliver', 'DeliveryController@deliver')->middleware('permissions:deliver');
            Route::name('getDeliveries')->get('deliveries', 'DeliveryController@getDeliveries')->middleware('permissions:deliver');
            Route::name('downloadDeliveryReport')->get('report/{from}/{to}', 'ReportsController@downloadDeilveryReports')->middleware('permissions:deliver');
        });

        Route::group(['prefix' => 'notifications/'], function () {
            Route::name('getNotifications')->get('', 'NotificationController@index')->middleware('permissions:deliver');
            Route::name('postMarkAsSeen')->post('seen', 'NotificationController@postMarkAsSeen')->middleware('permissions:deliver');
        });

    });

});
