<?php

Auth::routes();

Route::namespace('Dashboard')->prefix('/')->middleware(['auth'])->group(function(){
    Route::get('/', 'DashboardController@index');
});

Route::namespace('Account')->prefix('/account')->middleware('auth')->group(function(){
    Route::get('/', 'AccountController@index');
    Route::namespace('User')->prefix('/user')->group(function(){
        Route::get('/', 'UserController@edit');
        Route::patch('/', 'UserController@update');
    });
    Route::namespace('Clock')->prefix('/clock')->group(function(){
        Route::get('/1', 'ClockController@store');
        Route::get('/0', 'ClockController@destroy');
    });
    Route::namespace('Customer')->prefix('/customer')->group(function(){
        Route::get('/', 'CustomerController@index');
        Route::namespace('Ticket')->prefix('/ticket')->group(function(){
            Route::get('/', 'TicketController@index');
            Route::get('/create', 'TicketController@create');
            Route::post('/', 'TicketController@store');
            Route::prefix('/{ticketId}')->group(function() {
                Route::get('/', 'TicketController@show');
                Route::get('/edit', 'TicketController@edit');
                Route::patch('/', 'TicketController@update');
                Route::namespace('Facility')->prefix('/facility')->group(function(){
                    Route::get('/create', 'FacilityController@create');
                    Route::post('/', 'FacilityController@store');
                });
            });
        });
    });
});

Route::namespace('Search')->prefix('/search')->middleware(['auth','role:admin,employee'])->group(function(){
    Route::get('/', 'SearchController@index');
});

Route::namespace('Manage')->prefix('/manage')->middleware(['auth','role:admin,employee'])->group(function(){
    Route::namespace('Users')->prefix('/user')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/', 'UserController@store');
        Route::prefix('/{userId}')->group(function(){
            Route::get('/edit', 'UserController@edit');
            Route::patch('/', 'UserController@update');
            Route::delete('/', 'UserController@destroy');
        });
    });
    Route::namespace('Agenda')->prefix('/agenda')->middleware(['role:admin,employee'])->group(function(){
        Route::get('/', 'AgendaController@index');
    });
    Route::namespace('Customers')->prefix('/customer')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'CustomerController@index');
        Route::get('/create', 'CustomerController@create');
        Route::post('/', 'CustomerController@store');
        Route::prefix('/{customerId}')->group(function(){
            Route::get('/', 'CustomerController@show');
            Route::get('/edit', 'CustomerController@edit');
            Route::patch('/', 'CustomerController@update');
            Route::delete('/', 'CustomerController@destroy');
            Route::namespace('Facilities')->prefix('/facility')->group(function(){
                Route::get('/create', 'FacilityController@create');
                Route::post('/', 'FacilityController@store');
                Route::prefix('/{facilityId}')->group(function(){
                    Route::get('/', 'FacilityController@show');
                    Route::get('/edit', 'FacilityController@edit');
                    Route::patch('/', 'FacilityController@update');
                    Route::delete('/', 'FacilityController@destroy');
                    Route::namespace('Contacts')->prefix('/contact')->group(function(){
                        Route::get('/create', 'ContactController@create');
                        Route::post('/', 'ContactController@store');
                    });
                    Route::namespace('Maps')->prefix('/map')->group(function(){
                        Route::get('/create', 'MapController@create');
                        Route::post('/', 'MapController@store');
                    });
                });
            });
            Route::namespace('Contacts')->prefix('/contact')->group(function(){
                Route::get('/create', 'ContactController@create');
                Route::post('/', 'ContactController@store');
                Route::prefix('/{contactId}')->group(function(){
                    Route::get('/edit', 'ContactController@edit');
                    Route::patch('/', 'ContactController@update');
                    Route::delete('/', 'ContactController@destroy');
                    Route::namespace('User')->prefix('/user')->group(function(){
                        Route::get('/create', 'UserController@create');
                        Route::post('/', 'UserController@store');
                        Route::prefix('/{userId}')->group(function(){
                            Route::get('/edit', 'UserController@edit');
                            Route::patch('/', 'UserController@update');
                        });
                    });
                });
            });
        });
    });
    Route::namespace('Employees')->prefix('/employee')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'EmployeeController@index');
        Route::get('/create', 'EmployeeController@create');
        Route::post('/', 'EmployeeController@store');
        Route::prefix('/{employeeId}')->group(function(){
            Route::get('/', 'EmployeeController@show');
            Route::get('/edit', 'EmployeeController@edit');
            Route::patch('/', 'EmployeeController@update');
            Route::delete('/', 'EmployeeController@destroy');
            Route::namespace('Contacts')->prefix('/contact')->group(function(){
                Route::get('/edit', 'ContactController@edit');
                Route::patch('/', 'ContactController@update');
            });
            Route::namespace('Users')->prefix('/user')->group(function(){
                Route::get('/create', 'UserController@create');
                Route::post('/', 'UserController@store');
                Route::prefix('/{userId}')->group(function(){
                    Route::get('/edit', 'UserController@edit');
                    Route::patch('/', 'UserController@update');
                    Route::delete('/', 'UserController@destroy');
                });
            });
            Route::namespace('Schedules')->prefix('/schedule')->group(function(){
                Route::get('/', 'ScheduleController@show');
                Route::prefix('/{scheduleId}')->group(function() {
                    Route::get('/edit', 'ScheduleController@edit');
                    Route::patch('/', 'ScheduleController@update');
                });
                Route::namespace('Events')->prefix('/event')->group(function(){
                    Route::get('/create', 'EventController@create');
                    Route::post('/', 'EventController@store');
                    Route::prefix('/{eventId}')->group(function(){
                        Route::get('/edit', 'EventController@edit');
                        Route::patch('/', 'EventController@update');
                        Route::delete('/', 'EventController@destroy');
                    });
                });
            });
            Route::namespace('PayRates')->prefix('/pay-rate')->group(function(){
                Route::get('/', 'PayRateController@index');
                Route::get('/create', 'PayRateController@create');
                Route::post('/', 'PayRateController@store');
                Route::prefix('/{payRateId}')->group(function(){
                    Route::get('/edit', 'PayRateController@edit');
                    Route::patch('/', 'PayRateController@update');
                    Route::delete('/', 'PayRateController@destroy');
                });
            });
        });
    });
    Route::namespace('SupportVendors')->prefix('/support-vendor')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'SupportVendorController@index');
        Route::get('/create', 'SupportVendorController@create');
        Route::post('/', 'SupportVendorController@store');
        Route::prefix('/{supportVendorId}')->group(function(){
            Route::get('/edit', 'SupportVendorController@edit');
            Route::patch('/', 'SupportVendorController@update');
            Route::delete('/', 'SupportVendorController@destroy');
        });
    });
     Route::namespace('Assets')->prefix('/asset')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'AssetController@index');
        Route::get('/create', 'AssetController@create');
        Route::post('/', 'AssetController@store');
        Route::prefix('/{assetId}')->group(function(){
            Route::get('/', 'AssetController@show');
            Route::get('/edit', 'AssetController@edit');
            Route::patch('/', 'AssetController@update');
            Route::delete('/', 'AssetController@destroy');
            Route::namespace('Contacts')->prefix('/contact')->group(function(){
                Route::get('/create', 'ContactController@create');
                Route::post('/', 'ContactController@store');
                Route::prefix('/{contactId}')->group(function(){
                    Route::delete('/', 'ContactController@destroy');
                });
            });
            Route::namespace('Maps')->prefix('/map')->group(function(){
                Route::get('/create', 'MapController@create');
                Route::post('/', 'MapController@store');
                Route::prefix('/{mapId}')->group(function(){
                    Route::get('/', 'MapController@show');
                    Route::get('/edit', 'MapController@edit');
                    Route::patch('/', 'MapController@update');
                    Route::delete('/', 'MapController@destroy');
                });
            });
            Route::namespace('Assets')->prefix('/asset')->group(function(){
                Route::get('/create', 'AssetController@create');
                Route::post('/', 'AssetController@store');
                Route::prefix('/{contactId}')->group(function(){
                    Route::delete('/', 'ContactController@destroy');
                });
            });
        });
    });
    Route::namespace('Vehicles')->prefix('/vehicle')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'VehicleController@index');
        Route::get('/create', 'VehicleController@create');
        Route::post('/', 'VehicleController@store');
        Route::prefix('/{vehicleId}')->group(function(){
            Route::get('/', 'VehicleController@show');
            Route::get('/edit', 'VehicleController@edit');
            Route::patch('/', 'VehicleController@update');
            Route::delete('/', 'VehicleController@destroy');
        });
    });
    Route::namespace('Monitors')->prefix('/monitor')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'MonitorController@index');
        Route::get('/create', 'MonitorController@create');
        Route::post('/', 'MonitorController@store');
        Route::prefix('/{monitorId}')->group(function(){
            Route::get('/', 'MonitorController@show');
            Route::get('/edit', 'MonitorController@edit');
            Route::patch('/', 'MonitorController@update');
            Route::delete('/', 'MonitorController@destroy');
            Route::namespace('Pings')->prefix('/ping')->group(function(){
                Route::post('/', 'PingController@store');
            });
        });
    });
    Route::namespace('Maps')->prefix('/map')->group(function(){
        Route::get('/', 'MapController@index');
        Route::get('/create', 'MapController@create');
        Route::post('/', 'MapController@store');
        Route::namespace('Jump')->prefix('/jump')->group(function(){
            Route::namespace('View')->prefix('/view')->group(function(){
                Route::post('/', 'JumpController@store');
            });
        });
        Route::prefix('/{mapId}')->group(function(){
            Route::get('/', 'MapController@show');
            Route::get('/edit', 'MapController@edit');
            Route::patch('/', 'MapController@update');
            Route::delete('/', 'MapController@destroy');
            Route::namespace('View')->prefix('/view')->group(function(){
                Route::get('/', 'ViewController@index');
                Route::namespace('Markers')->prefix('/marker')->group(function(){
                    Route::get('/create', 'MarkerController@create');
                    Route::post('/', 'MarkerController@store');
                    Route::prefix('/{markerId}')->group(function(){
                        Route::get('/', 'MarkerController@show');
                        Route::get('/edit', 'MarkerController@edit');
                        Route::patch('/', 'MarkerController@update');
                        Route::delete('/', 'MarkerController@destroy');
                    });
                });
            });
        });
    });
    Route::namespace('Credentials')->prefix('/credential')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'CredentialController@index');
        Route::get('/create', 'CredentialController@create');
        Route::post('/', 'CredentialController@store');
        Route::prefix('/{credentialId}')->group(function(){
            Route::get('/', 'CredentialController@show');
            Route::get('/edit', 'CredentialController@edit');
            Route::patch('/', 'CredentialController@update');
            Route::delete('/', 'CredentialController@destroy');
        });
    });
    Route::namespace('Tickets')->prefix('/ticket')->middleware(['role:admin'])->group(function(){
        Route::get('/', 'TicketController@index');
        Route::get('/create', 'TicketController@create');
        Route::post('/', 'TicketController@store');
        Route::prefix('/{ticketId}')->group(function(){
            Route::get('/', 'TicketController@show');
            Route::get('/edit', 'TicketController@edit');
            Route::patch('/', 'TicketController@update');
            Route::delete('/', 'TicketController@destroy');
            Route::namespace('Contacts')->prefix('/contact')->group(function(){
                Route::get('/create', 'ContactController@create');
                Route::post('/', 'ContactController@store');
                Route::prefix('/{contactId}')->group(function(){
                    Route::delete('/', 'ContactController@destroy');
                });
            });
            Route::namespace('Notes')->prefix('/note')->group(function(){
                Route::get('/create', 'NoteController@create');
                Route::post('/', 'NoteController@store');
                Route::prefix('/{noteId}')->group(function(){
                    Route::get('/edit', 'NoteController@edit');
                    Route::patch('/', 'NoteController@update');
                    Route::delete('/', 'NoteController@destroy');
                });
            });
            Route::namespace('Employees')->prefix('/employee')->group(function(){
                Route::get('/create', 'EmployeeController@create');
                Route::post('/', 'EmployeeController@store');
                Route::prefix('/{employeeId}')->group(function(){
                    Route::delete('/', 'EmployeeController@destroy');
                });
            });
        });
    });

    Route::namespace('Schedules')->prefix('/schedule')->middleware(['role:admin'])->group(function(){
        Route::namespace('Defaults')->prefix('/default')->group(function(){
            Route::get('/', 'DefaultController@show');
            Route::get('/edit', 'DefaultController@edit');
            Route::patch('/', 'DefaultController@update');
            Route::namespace('Events')->prefix('/event')->group(function(){
                Route::get('/create', 'EventController@create');
                Route::post('/', 'EventController@store');
                Route::prefix('/{eventId}')->group(function(){
                    Route::get('/edit', 'EventController@edit');
                    Route::patch('/', 'EventController@update');
                    Route::delete('/', 'EventController@destroy');
                });
            });
        });
    });

    Route::namespace('Inventories')->prefix('/inventory')->middleware(['role:admin'])->group(function(){
        Route::get('/','ProductController@index');
        Route::get('create','ProductController@create');
        Route::post('/', 'ProductController@store');
        Route::prefix('/{productId}')->group(function(){
            Route::get('/', 'ProductController@show');
            Route::get('/edit', 'ProductController@edit');
            Route::patch('/', 'ProductController@update');
            Route::delete('/', 'ProductController@destroy');
        });
    });

});

Route::namespace('Uploads')->prefix('/uploads')->group(function(){
    Route::namespace('Logos')->prefix('/logo')->group(function(){
        Route::get('{any}', 'UploadController@show')->where('any', '.*');
    });
    Route::namespace('Images')->prefix('/image')->group(function(){
        Route::get('{any}', 'UploadController@show')->where('any', '.*');
    });
});

Route::namespace('Branding')->prefix('/branding')->group(function(){
    Route::get('{any}', 'BrandingController@show')->where('any', '.*');
});