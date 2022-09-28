<?php
use App\Http\Controllers\UsersController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

// Auth::routes();
Auth::routes([
    'verify' => true,
    // 'register' => false,
    ]);
    
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/changePassword','UserController@showChangePasswordForm')->name('user.changepassword');

// Logs report
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// Profile
Route::get('profile', 'UserController@profile')->name('user.profile');
Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
Route::get('profile/change-password', 'UserController@editPassword')->name('profile.editPassword');
Route::post('/profile/update', 'UserController@update')->name('profile.update');
Route::post('/profile/update-password', 'UserController@updatePassword')->name('profile.updatePassword');
Route::get('profile/favorites', 'UserController@favorites')->name('profile.favorites');
Route::get('user/vehicles', 'UserController@vehicles')->name('user.vehicles');
// Route::post('profile/vehicles/add', 'UserController@addVehicle')->name('profile.addvehicle');
// Route::patch('profile/vehicles/updated/{id}', 'UserController@updateVehicle')->name('profile.updatevehicle');
Route::get('verified', 'UserController@verified')->name('user.verified')->middleware('verified');

// User Vehicles
Route::resource('profile/vehicles', 'VehiclesController');

// Lang
Route::get('locale/{locale}', function($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('totelegram', 'PagesController@toTelegram');

// Route::get('/', function()
// {
//     return view('welcome');
// });

Route::get('/', 'PagesController@home')->name('home');
Route::get('/home-design', 'PagesController@homeDesign')->name('home.design');

// Dinamic service -> To location
Route::get('servicesto/{id}', 'PagesController@servicesTo');
Route::get('servicestoairports/{id}', 'PagesController@servicesToAirports'); 

// Notifications
Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
Route::get('notifications/{bid}', 'NotificationsController@bid')->name('notifications.bid');
Route::get('notifications/{id}', 'NotificationsController@show')->name('notifications.show');
Route::patch('notifications/{id}', 'NotificationsController@read')->name('notifications.read');
Route::delete('notifications/{id}', 'NotificationsController@destroy')->name('notifications.destroy');


// Pages
Route::get('home', ['uses' => 'PagesController@home', 'as' => 'pages.home']);
Route::get('about-us', ['uses' => 'PagesController@about', 'as' => 'pages.about']);
Route::get('faqs', ['uses' => 'PagesController@faqs', 'as' => 'pages.faqs']);
Route::get('contact-us', 'MessagesController@create')->name('pages.contactus');
Route::get('how-does-it-work', ['uses' => 'PagesController@howworks', 'as' => 'pages.howworks']);
Route::get('hotel', 'PagesController@hotel')->name('pages.hotel');
Route::get('agency', 'PagesController@agency')->name('pages.agency');
Route::get('operator', 'PagesController@operator')->name('pages.operator');
Route::get('overview', 'PagesController@overview')->name('pages.overview');
Route::get('rules', 'PagesController@rules')->name('pages.rules');
Route::get('instructions', 'PagesController@instructions')->name('pages.instructions');
Route::get('instructions/{instruction}', 'PagesController@instruction_show')->name('pages.instruction-show');
Route::get('gps', 'PagesController@gps')->name('pages.gps');
Route::get('marketing', 'PagesController@marketing')->name('pages.marketing');
Route::get('punta-cana', 'PagesController@punta_cana')->name('pages.punta_cana');
Route::get('santo-domingo', 'PagesController@santo_domingo')->name('pages.santo_domingo');
Route::get('terms-and-conditions', 'PagesController@terms')->name('pages.terms');
Route::get('privacy-policy', 'PagesController@privacypolicy')->name('pages.privacypolicy');

// Messages
Route::resource('messages', 'MessagesController');

// My Auctions
Route::group(['prefix' => 'myauctions'], function () {
    // Route::get('/', 'MyAuctionsController@index')->name('myauctions.index');
    Route::get('create', 'MyAuctionsController@create')->name('myauctions.create');
    Route::post('store', 'MyAuctionsController@store')->name('myauctions.store');
    Route::get('{id}', 'MyAuctionsController@show')->name('myauctions.show');
    Route::get('{id}/edit', 'MyAuctionsController@edit')->name('myauctions.edit');
    Route::get('{id}/first_step', 'MyAuctionsController@first_step')->name('myauctions.first_step');
    Route::patch('/first_step_update/{id}', 'MyAuctionsController@first_step_update')->name('myauctions.first_step_update');
    Route::patch('{id}', 'MyAuctionsController@update')->name('myauctions.update');
    Route::delete('{id}', 'MyAuctionsController@destroy')->name('myauctions.destroy');
    Route::patch('destroy2/{auction}', 'MyAuctionsController@destroy2')->name('myauctions.destroy2');
    // Add new auction by category
    Route::get('create/private', 'MyAuctionsController@createprivate')->name('myauctions.createprivate');
    Route::get('create/sharing', 'MyAuctionsController@createsharing')->name('myauctions.createsharing');
    Route::get('create/tour', 'MyAuctionsController@createtour')->name('myauctions.createtour');
    Route::get('create/emptylegs', 'MyAuctionsController@createemptylegs')->name('myauctions.createemptylegs');

    // Route::get('sharing/index', 'MyAuctionsController@sharing')->name('myauctions.sharing');
    Route::get('tours/index', 'MyAuctionsController@tours')->name('myauctions.tours');
    Route::get('empty-legs/index', 'MyAuctionsController@emptylegs')->name('myauctions.emptylegs');
    Route::get('trash/index', 'MyAuctionsController@trash')->name('myauctions.trash');
    Route::get('incomplete/index', 'MyAuctionsController@incomplete')->name('myauctions.incomplete');

    Route::get('myauctions-open', ['uses' => 'MyAuctionsController@open', 'as' => 'myauctions.open']);
    Route::get('myauctions-closed', ['uses' => 'MyAuctionsController@closed', 'as' => 'myauctions.closed']);
    Route::patch('recover/{auction}', 'MyAuctionsController@recover');

    // Rourtes for change auction with bids
    Route::get('change/{id}', 'MyAuctionsController@change')->name('myauctions.change');
    Route::patch('changed/{id}', 'MyAuctionsController@changed');

    // Private transfers filters
    Route::get('privatetransfers/index', 'MyAuctionsController@index')->name('privatetransfers.index');
    Route::get('privatetransfers/nobidyet', 'MyAuctionsController@privatenobidyet')->name('privatetransfers.nobidyet');
    Route::get('privatetransfers/openbid', 'MyAuctionsController@privateopenbid')->name('privatetransfers.openbid');
    Route::get('privatetransfers/accepted', 'MyAuctionsController@privateaccepted')->name('privatetransfers.accepted');
    Route::get('privatetransfers/archived', 'MyAuctionsController@archived')->name('privatetransfers.archived');
    Route::get('show/accepted/{id}', 'MyAuctionsController@accepted')->name('privatetransfers.showaccepted');

    // Shared Shuttles filters
    Route::get('sharedshuttles/index', 'MyAuctionsController@sharing')->name('sharedshuttles.index');
    Route::get('sharedshuttles/nobidyet', 'MyAuctionsController@sharingnobidyet')->name('sharedshuttles.nobidyet');
    Route::get('sharedshuttles/openbid', 'MyAuctionsController@sharingopenbid')->name('sharedshuttles.openbid');
    Route::get('sharedshuttles/accepted', 'MyAuctionsController@sharingaccepted')->name('sharedshuttles.accepted');




});
// Dynamic dropdows
Route::get('/from_locations/{id}', 'MyAuctionsController@from_locations');
Route::get('/to_locations/{id}', 'MyAuctionsController@to_locations');
Route::get('to_airport', 'BookingsController@to_airport');
Route::get('/getlocations/{id}', 'LocationsController@getlocations');
Route::get('/getregions/{id}', 'LocationsController@getregions');

// Dynamic dropdows
Route::get('/service-from/{id}', 'ServicesController@from');
Route::get('/service-to/{id}', 'ServicesController@to');

// Bestbid JSON
Route::get('/bestbid/{id}', 'AuctionsController@bestbid');

// Bid count JSON
Route::get('/bidcount/{id}', 'AuctionsController@bidcount');


// Extras passenger
Route::get('extraspass', 'ExtrasPassengersController@index')->name('extraspass.index');
Route::post('extraspass/{auction_id}', 'ExtrasPassengersController@store')->name('extraspass.store');
Route::delete('extraspass/{id}', 'ExtrasPassengersController@destroy')->name('extraspass.destroy');

// Extras providers
Route::post('extraspro/{auction_id}', 'ExtrasProvidersController@store')->name('extraspro.store');
Route::delete('extraspro/{id}', 'ExtrasProvidersController@destroy')->name('extraspro.destroy');


// My Bids
Route::group(['prefix' => 'mybids'], function () {
    Route::get('/', 'MyBidsController@index')->name('mybids.index');
    Route::get('create', 'MyAuctionsController@create')->name('mybids.create');
    Route::post('store', 'MyAuctionsController@store')->name('mybids.store');
    Route::get('{id}', 'MyAuctionsController@show')->name('mybids.show');
    Route::get('{id}/edit', 'MyAuctionsController@edit')->name('mybids.edit');
    Route::patch('{id}', 'MyAuctionsController@update')->name('mybids.update');
    Route::delete('{id}', 'MyAuctionsController@destroy')->name('mybids.destroy');

    Route::get('won/index', 'MyBidsController@won')->name('mybids.won');
    Route::get('lost/index', 'MyBidsController@lost')->name('mybids.lost');
    Route::get('canceled/index', 'MyBidsController@canceled')->name('mybids.canceled');
    Route::get('showauction/{auction_id}', 'MyBidsController@showauction');
    Route::get('changedauction/{auction_id}', 'MyBidsController@changedauction');
});

// Auctions
Route::resource('auctions', 'AuctionsController');
Route::get('administration/auctions-tourist', ['uses' => 'AuctionsController@touristAuctions', 'as' => 'auctions.tourist']);
Route::get('administration/auctions-agencies', ['uses' => 'AuctionsController@agenciesAuctions', 'as' => 'auctions.agencies']);
Route::get('transfers', ['uses' => 'AuctionsController@transfers', 'as' => 'auctions.transfers']);
Route::get('manageauctions/', ['uses' => 'AuctionsController@index', 'as' => 'manageauctions.index']);
Route::get('manageauctions/show/{auction}', ['uses' => 'AuctionsController@auction_show', 'as' => 'manageauctions.show']);
Route::get('manageauctions/agency-auction/{auction}', ['uses' => 'AuctionsController@agencyAuctionShow', 'as' => 'manageauctions.agencyAuctionShow']);
Route::patch('manageauctions/checked/{id}', 'AuctionsController@checkedBy')->name('manageauctions.checkedby');

// GATEGORIES //

// Private Transfers auctions
Route::get('auctions/privatetransfers/index', 'PrivateTransfersController@index')->name('auctions.privatetransfers');
Route::get('auctions/privatetransfers/open', 'PrivateTransfersController@open')->name('auctions.privateopen');
Route::get('auctions/privatetransfers/winning', 'PrivateTransfersController@winning')->name('auctions.privatewinning');
Route::get('auctions/privatetransfers/losing', 'PrivateTransfersController@losing')->name('auctions.privatelosing');
Route::get('auctions/privatetransfers/accepted', 'PrivateTransfersController@accepted')->name('auctions.privateaccepted');
Route::get('auctions/privatetransfers/bidbyme', 'PrivateTransfersController@bidbyme')->name('auctions.privatebidbyme');
Route::get('auctions/privatetransfers/won', 'PrivateTransfersController@won')->name('auctions.privatewon');
Route::get('auctions/privatetransfers/lost', 'PrivateTransfersController@lost')->name('auctions.privatelost');

// Shared Shuttles auctions
Route::get('auctions/sharedshuttles/index', 'SharedShuttlesController@index')->name('auctions.sharedshuttles');
Route::get('auctions/sharedshuttles/nobidded', 'SharedShuttlesController@nobidded')->name('auctions.sharednobidded');
Route::get('auctions/sharedshuttles/bidded', 'SharedShuttlesController@bidded')->name('auctions.sharedbidded');
Route::get('auctions/sharedshuttles/accepted', 'SharedShuttlesController@accepted')->name('auctions.sharedaccepted');

// Dynamic dropdows for transfer
Route::get('/from/{id}', 'AuctionsController@from_locations');
Route::get('/json-from', 'AuctionsController@f_locations');
Route::get('/to/{id}', 'AuctionsController@to_locations');




// Tours
Route::resource('tours', 'ToursController');
Route::post('tours/{tour_id}', ['uses' => 'ToursController@storeBid', 'as' => 'tours.storeBid']);
Route::get('tours', ['uses' => 'ToursController@tours', 'as' => 'tours.tours']);

// Bids
// Route::resource('bids', 'BidsController');
Route::get('bids', 'BidsController@index');
// Route::get('bids/{bid}', 'BidsController@show')->name('bids.show');
Route::post('bids/{auction_id}', ['uses' => 'BidsController@store', 'as' => 'bids.store']);
Route::post('bidsfromtransfers/{auction_id}', ['uses' => 'BidsController@storefromtransfers', 'as' => 'bids.storefromtransfers']);
Route::post('bidsfromtransfers2/{auction_id}', ['uses' => 'BidsController@storefromtransfers2', 'as' => 'bids.storefromtransfers2']);

Route::delete('bids/{bid}', 'BidsController@destroy');
Route::patch('bids/{bid}', 'BidsController@update');
Route::patch('bidstour/{bid}', 'BidsController@updateTour');

// My account
Route::resource('account', 'AccountController');
Route::get('my-auctions', [ 'uses' => 'AccountController@auctions' , 'as' => 'account.my-auctions']);
Route::get('my-bids', 'AccountController@bids');
Route::get('my-auctions/{auction}', 'AccountController@showauction');

Route::get('my-tours', 'AccountController@tours');
Route::get('my-tours/{tour}', 'AccountController@showTour');
Route::get('my-tours', [ 'uses' => 'AccountController@tours' , 'as' => 'account.my-tours']);
Route::get('create-tour', [ 'uses' => 'AccountController@createTour' , 'as' => 'account.createtour']);
Route::get('transfers-bids', ['uses' => 'AccountController@auctionsBids', 'as' => 'account.transfers-bids']);
Route::get('tours-bids', ['uses' => 'AccountController@toursBids', 'as' => 'account.tours-bids']);

//Admin

Route::group(['prefix' => 'administration', 'middleware' => ['admin']], function () {
    Route::get('/', [ 'uses' => 'Admin\AdminController@index', 'as' => 'admin.dashboard']);
    // Route::get('projects', 'ProjectsController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('ctivitylogs', 'Admin\ActivityLogsController')->only(['index', 'show', 'destroy']);
    Route::resource('settings', 'Admin\SettingsController');
    // Route::resource('extras', 'ExtrasController');
    Route::resource('tasks', 'TasksController');
    Route::resource('updates', 'UpdatesController');
    // Route::resource('locations', 'LocationsController');
    Route::resource('places', 'PlacesController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
    Route::resource('faqs', 'FaqsController');
    Route::resource('instructions', 'InstructionController');

    // Content
    Route::resource('content/pages', 'Admin\PagesController');
    Route::resource('content/attractions', 'AttractionsController');
    Route::resource('content/tours', 'ToursController');
    Route::resource('content/posts', 'PostsController');
    Route::delete('post/delete/imagen/{id}', 'PostsController@deleteImage');
    Route::resource('content/whales', 'AdminWhalesController');
    Route::resource('content/locations', 'ManageLocationsController');
    Route::resource('content/sliders', 'SlidersController');
});

// Route::get('admin/dashboard', [ 'uses' => 'Admin\AdminController@index', 'as' => 'admin.dashboard']);
// // Route::resource('admin', 'Admin\AdminController');
// Route::resource('admin/roles', 'Admin\RolesController');
// Route::resource('admin/permissions', 'Admin\PermissionsController');
// Route::resource('admin/users', 'Admin\UsersController');
// Route::resource('admin/pages', 'Admin\PagesController');
// Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
//     'index', 'show', 'destroy'
// ]);
// Route::resource('admin/settings', 'Admin\SettingsController');
// Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
// Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

// // FAQs
// Route::resource('admin/faqs', 'FaqsController');

// ADMINISTRATION
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show');
Route::get('users/{id}/auctions', 'UsersController@auctions')->name('users.auctions');

Route::resource('tasks', 'TasksController');

Route::post('follow/{user}', 'UsersController@store');

// Booking
Route::get('booknow', 'BookingsController@index')->name('booknow');
Route::post('booking/store', 'BookingsController@store')->name('booking.store');
Route::get('select_vehicle/{key}/edit', 'BookingsController@edit')->name('booking.edit');
// Route::patch('booking/{id}', 'BookingsController@update')->name('booking.update');
Route::patch('booking/{id}', 'BookingsController@update')->name('booking.update');
Route::patch('fromto/{id}', 'BookingsController@fromto')->name('booking.fromto');
Route::get('second_step/{key}', 'BookingsController@show')->name('booking.show');
Route::get('booking/auction/{key}', 'BookingsController@auctionShow')->name('booking.auctionShow');
Route::get('booking/confirmation/{key}', 'BookingsController@confirmation')->name('booking.confirmation');
Route::get('booking/complete_form/{key}/edit', 'BookingsController@completeForm')->name('booking.completeform');
Route::patch('booking/assign/price/{id}', 'BookingsController@assignPrice')->name('services.assignPrice');
Route::patch('booking/assign/service/{id}', 'BookingsController@assignService')->name('services.assignService');
Route::patch('booking/assign/status/{id}', 'BookingsController@assignStatus')->name('services.assignStatus');
Route::post('booking/transfer', 'BookingsController@transfer')->name('services.transfer');
Route::get('step_two/{key}/edit', 'BookingsController@stepTwo')->name('booking.stepTwo');
Route::patch('booking/save/{id}', 'BookingsController@bookingSave')->name('booking.bookingsave');
Route::get('booking/mybooking/{auction_id}', 'BookingsController@myBooking')->name('booking.myBooking');
Route::get('booking/search', 'BookingsController@bookingSearch')->name('booking.bookingSearch');
// Route::get('booking/mybooking/', 'BookingsController@myBooking')->name('booking.mybooking');
Route::patch('booking/acceptsb/{id}', 'BookingsController@acceptStartingBid')->name('booking.acceptStartingBid');
Route::get('booking/extras/{key}', 'BookingsController@extras')->name('booking.extras');
Route::get('booking/closed/{key}', 'BookingsController@auctionClosed')->name('booking.closed');
Route::delete('booking/cancel/{id}', 'BookingsController@cancel')->name('booking.cancel');

// Accept bid
Route::post('booking-bid/', ['uses' => 'BookingsController@bookingbid', 'as' => 'bids.bookingbid']);
Route::post('agency-auction-bid/', ['uses' => 'BidsController@agencyBidStore', 'as' => 'bids.agencyBidStore']);
Route::patch('booking/accept-bid/{id}', ['uses' => 'BookingsController@acceptBid', 'as' => 'bids.acceptBid']);
Route::patch('booking/accept/currentbid/{id}', 'BookingsController@acceptCurrentBid')->name('services.acceptCurrentBid');

// Change to one-way or round-trip
Route::patch('booking/oneway/{id}', 'BookingsController@oneway')->name('booking.oneway');
Route::patch('booking/roundtrip/{id}', 'BookingsController@roundtrip')->name('booking.roundtrip');


// Confirmation
Route::get('thankyou', 'ConfirmationController@index')->name('confirmation.index');


// Tourist Bookings
Route::get('booking/tourist-boogings', 'BookingsController@touristBookings')->name('booking.touristBookings');

// Tourist Auctions
Route::get('booking/tourist-auctions', 'BookingsController@touristAuctions')->name('booking.touristAuctions');


// Modules
Route::get('settings', 'ModulesController@index')->name('system.settings');
Route::post('system/update', 'ModulesController@updateShared')->name('system.update');

Route::get('check-queue', function(){
    Mail::to('jbaezgis@gmail.com')->send(new TestMail());

    return 'Working';
});

// Manage
Route::group(['prefix' => 'manage', 'middleware' => ['admin']], function () {
    // Users
    Route::resource('users', 'AdminUsersController');
    Route::patch('users/changepassword/{id}', 'AdminUsersController@changePassword')->name('users.changepassword');
    Route::patch('users/verificate/{id}', 'AdminUsersController@verificate')->name('users.verificate');
    Route::patch('users/activate/{bid}', 'AdminUsersController@activate')->name('users.activate');
    Route::patch('users/deactivate/{bid}', 'AdminUsersController@deactivate')->name('users.deactivate');
    // Auctions
    Route::resource('auctions', 'AuctionsController');
});

// Services
Route::group(['prefix' => 'services'], function () {
    Route::get('/', 'ServicesController@index')->name('services.index');
    Route::get('/create', 'ServicesController@create')->name('services.create');
    Route::post('/store', 'ServicesController@store')->name('services.store');
    Route::get('/{id}/edit', 'ServicesController@edit')->name('services.edit');
    Route::patch('/{id}', 'ServicesController@update')->name('services.update');
    Route::delete('/{id}', 'ServicesController@destroy')->name('services.destroy');
    Route::get('/{id}/show', 'ServicesController@show')->name('services.show');

    //Service Prices
    Route::post('price/store', 'ServicesController@servicePrice')->name('services.servicePrice');
    Route::delete('price/delete/{id}', 'ServicesController@destroyServicePrice');
});

// Payment
Route::post('payment/stripe', 'PaymentController@stripePayment')->name('payment.stripe');

// Request payment link
Route::post('request-payment', 'PaymentController@requestPayment')->name('payment.request_payment');

// Locations
Route::group(['prefix' => 'locations'], function () {
    // Countries
    Route::get('countries/', 'CountriesController@index')->name('countries.index');
    Route::get('countries/create', 'CountriesController@create')->name('countries.create');
    Route::post('countries/store', 'CountriesController@store')->name('countries.store');
    Route::get('countries/{id}/edit', 'CountriesController@edit')->name('countries.edit');
    Route::patch('countries/{id}', 'CountriesController@update')->name('countries.update');
    Route::delete('countries/{id}', 'CountriesController@destroy')->name('countries.destroy');
    Route::get('countries/{id}/show', 'CountriesController@show')->name('countries.show');
    
    // Regions 
    Route::get('/{id}/regions', 'RegionsController@index')->name('regions.index');
    Route::get('{id}/regions/create', 'RegionsController@create')->name('regions.create');
    Route::post('/regions/store', 'RegionsController@store')->name('regions.store');
    Route::get('regions/{id}/edit', 'RegionsController@edit')->name('regions.edit');
    Route::patch('regions/{id}', 'RegionsController@update')->name('regions.update');
    Route::delete('/regions/delete/{id}', 'RegionsController@destroy')->name('regions.delete');
    Route::get('regions/{id}/show', 'RegionsController@show')->name('regions.show');
    
    // Locations
    Route::get('/{id}/locations', 'LocationsController@index')->name('locations.index');
    Route::get('locations/create', 'LocationsController@create')->name('locations.create');
    Route::post('/locations/store', 'LocationsController@store')->name('locations.store');
    Route::post('/locations/newlocation', 'LocationsController@newLocation')->name('locations.newLocation');
    Route::get('locations/{id}/edit', 'LocationsController@edit')->name('locations.edit');
    Route::patch('locations/{id}', 'LocationsController@update')->name('locations.update');
    Route::delete('/locations/delete/{id}', 'LocationsController@destroy')->name('locations.delete');
    Route::get('locations/{id}/show', 'LocationsController@show')->name('locations.show');
});

// Extras
Route::resource('extras', 'ExtrasController');


// Suppliers
Route::get('suppliers/index', 'AllAuctionsController@index')->name('suppliers.index');
Route::get('suppliers/open', 'AllAuctionsController@open')->name('suppliers.open');
Route::get('suppliers/mybids', 'AllAuctionsController@mybids')->name('suppliers.mybids');
Route::get('suppliers/won', 'AllAuctionsController@won')->name('suppliers.won');
Route::get('suppliers/lost', 'AllAuctionsController@lost')->name('suppliers.lost');
Route::get('suppliers/auction/{id}', 'AllAuctionsController@show')->name('suppliers.show');


// Jobs
Route::get('jobs', 'JobsController@index')->name('jobs.index');
Route::delete('/jobs/{id}', 'JobsController@destroy')->name('job.delete');
Route::get('/jobs/destroy150', 'JobsController@destroy150')->name('job.delete150');
Route::get('/jobs/destroyall', 'JobsController@destroyAll')->name('job.deleteAll');

// Mexico
Route::get('mexico/puertovallarta', 'MexicoController@index')->name('mexico.puertovallarta');

// Whales
Route::prefix('whales')->group(function () {
    Route::get('/', 'WhalesController@index');
	Route::get('option-one', 'WhalesController@optionOne');
	Route::get('option-two', 'WhalesController@optionTwo');
	Route::get('option-three', 'WhalesController@optionThree');
	Route::get('option-four', 'WhalesController@optionFour');
	Route::get('option-group-one', 'WhalesController@optionGroupOne');
	Route::get('option-group-two', 'WhalesController@optionGroupTwo');
	Route::get('thanks', 'WhalesController@thanks');
});

// Orders
Route::resource('orders','OrdersController');

Route::post('exclusive', 'OrdersController@exclusive');
Route::post('exclusiveoption', 'OrdersController@exclusiveoption');

// Show Post
Route::get('post/{slug}', 'PostsController@post')->name('posts.post');

// Show tour
Route::get('tour/{slug}', 'ToursController@tour')->name('tours.tour');

// Show location
Route::get('/{slug}', 'ManageLocationsController@location')->name('locations.location');

// Show attraction
Route::get('attraction/{slug}', 'AttractionsController@attraction')->name('attractions.attraction');

// Validate email realtime
// Route::post('/checkemail',['uses'=>'PagesController@checkEmail']);
Route::post('/checkemail', 'PagesController@checkemail')->name('email_available.checkemail');

// Country Filter
Route::get('country/{country}/transfers', 'CountryFilterController@index')->name('country.transfers');
Route::get('country/{country}/{region}/transfers', 'CountryFilterController@region')->name('country.regiontransfers');
Route::get('country/{country}/location/{location_id}/transfers', 'CountryFilterController@location')->name('country.locationtransfers');
Route::get('country/{country}/tours', 'CountryFilterController@tours')->name('country.tours');
Route::get('country/{country}/{attraction}/attraction', 'CountryFilterController@attraction')->name('country.attraction');
Route::get('country/{country}/{tour}/tour', 'CountryFilterController@tour')->name('country.tour');
Route::get('country/{country}/flights', 'CountryFilterController@flights')->name('country.flights');

// Tour Reservations
Route::resource('tours/reservation','ToursReservesController');

Route::get('booking/bids/{key}', 'BookingsController@fakebids')->name('bookings.fakebids');

Route::resource('fakebids', 'FakeBidsController');

Route::get('administration/coupons', 'CouponsController@index')->name('coupons.index');
Route::post('coupons/store', 'CouponsController@store')->name('coupons.store');
Route::patch('coupons/coupon/{id}', 'CouponsController@coupon')->name('coupons.coupon');
Route::delete('coupons/{id}', 'CouponsController@destroy')->name('coupons.destroy');

Route::patch('booking/apply/coupon/{id}', 'BookingsController@applyCoupon')->name('booking.applyCoupon');

Route::get('administration/transfers/list', 'ServicesListController@index')->name('serviceslist.index');
Route::get('transfer/{from}/{to}', 'ServicesListController@show')->name('serviceslist.show');

