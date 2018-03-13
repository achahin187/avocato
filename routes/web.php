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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/issues_types', 'IssuesTypesController@index')->name('issues_types');
Route::post('/issues_types_store', 'IssuesTypesController@store')->name('issues_types_store');

Route::get('/governorates_cities', 'GovernoratesCitiesController@index')->name('governorates_cities');
Route::post('/governorates_cities/addGovernment', 'GovernoratesCitiesController@storeGovernment')->name('governoratesCities.addGovernment');
Route::post('/governorates_cities/addCity', 'GovernoratesCitiesController@storeCity')->name('governoratesCities.addCity');
Route::delete('/governorates_cities/destroy/{id}', 'GovernoratesCitiesController@destroy')->name('governorates_cities.destroy');
Route::delete('/governorates_cities/destroySelected', 'GovernoratesCitiesController@destroySelected')->name('governorates_cities.destroySelected');
Route::post('/governorates_cities/exportXLS', 'GovernoratesCitiesController@exportXLS')->name('governorates_cities.exportXLS');


Route::get('/courts_list', 'CourtsListController@index')->name('courts_list');

Route::get('/contracts_formulas_types', 'ContractsFormulasTypesController@index')->name('contracts_formulas_types');
Route::get('/consultations_classification', 'ConsultationsClassificationController@index')->name('consultations_classification');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/about_edit', 'AboutController@edit')->name('about_edit');

Route::get('/formulas', 'FormulasController@index')->name('formulas');
Route::get('/formulas_create', 'FormulasController@create')->name('formulas_create');
Route::get('/formulas_edit', 'FormulasController@edit')->name('formulas_edit');

Route::get('/users_list', 'UsersListController@index')->name('users_list');
Route::get('/user_profile', 'UsersListController@show')->name('user_profile');
Route::get('/users_list_create', 'UsersListController@create')->name('users_list_create');
Route::get('/users_list_edit', 'UsersListController@edit')->name('users_list_edit');

Route::get('/news_list', 'NewsListController@index')->name('news_list');
Route::get('/news_list_show', 'NewsListController@show')->name('news_list_show');
Route::get('/news_list_create', 'NewsListController@create')->name('news_list_create');
Route::get('/news_list_edit', 'NewsListController@edit')->name('news_list_edit');

Route::get('/clients', 'ClientsController@index')->name('clients');

Route::get('/individuals', 'IndividualsController@index')->name('individuals');
Route::get('/individuals_show', 'IndividualsController@show')->name('individuals_show');
Route::get('/individuals_create', 'IndividualsController@create')->name('individuals_create');
Route::get('/individuals_edit', 'IndividualsController@edit')->name('individuals_edit');

Route::get('/companies', 'CompaniesController@index')->name('companies');
Route::get('/companies_show', 'CompaniesController@show')->name('companies_show');
Route::get('/companies_create', 'CompaniesController@create')->name('companies_create');
Route::get('/companies_edit', 'CompaniesController@edit')->name('companies_edit');

Route::get('/individuals_companies', 'IndividualsCompaniesController@index')->name('individuals_companies');
Route::get('/individuals_companies_show', 'IndividualsCompaniesController@show')->name('individuals_companies_show');
Route::get('/individuals_companies_create', 'IndividualsCompaniesController@create')->name('individuals_companies_create');
Route::get('/individuals_companies_edit', 'IndividualsCompaniesController@edit')->name('individuals_companies_edit');

Route::get('/mobile', 'MobileController@index')->name('mobile');
Route::get('/mobile_show', 'MobileController@show')->name('mobile_show');

Route::get('/notifications', 'NotificationsController@index')->name('notifications');

Route::get('/complains', 'ComplainsController@index')->name('complains');
Route::get('/complains_edit', 'ComplainsController@edit')->name('complains_edit');

Route::get('/lawyers', 'LawyersController@index')->name('lawyers');
Route::get('/lawyers_follow', 'LawyersController@follow')->name('lawyers_follow');
Route::get('/lawyers_show', 'LawyersController@show')->name('lawyers_show');
Route::get('/lawyers_create', 'LawyersController@create')->name('lawyers_create');
Route::get('/lawyers_edit', 'LawyersController@edit')->name('lawyers_edit');

Route::get('/legal_consultations', 'LegalConsultationsController@index')->name('legal_consultations');
Route::get('/legal_consultations_show', 'LegalConsultationsController@show')->name('legal_consultations_show');
Route::get('/legal_consultations_create', 'LegalConsultationsController@create')->name('legal_consultations_create');
Route::get('/legal_consultations_edit', 'LegalConsultationsController@edit')->name('legal_consultations_edit');
Route::get('/legal_consultations_assign', 'LegalConsultationsController@assign')->name('legal_consultations_assign');


Route::get('/issues', 'IssuesController@index')->name('issues');
Route::get('/issues_show', 'IssuesController@show')->name('issues_show');
Route::get('/issues_archive_show', 'IssuesController@archive_show')->name('issues_archive_show');
Route::get('/issues_create', 'IssuesController@create')->name('issues_create');
Route::get('/issues_edit', 'IssuesController@edit')->name('issues_edit');

Route::get('/services', 'ServicesController@index')->name('services');
Route::get('/services_show', 'ServicesController@show')->name('services_show');
Route::get('/services_create', 'ServicesController@create')->name('services_create');
Route::get('/services_edit', 'ServicesController@edit')->name('services_edit');

Route::get('/tasks_normal', 'TasksController@normal_index')->name('tasks_normal');
Route::get('/tasks_emergency', 'TasksController@emergency_index')->name('tasks_emergency');

Route::get('/reports_statistics', 'ReportsStatisticsController@index')->name('reports_statistics');

Route::get('/records', 'RecordsController@index')->name('records');
Route::get('/records_create', 'RecordsController@create')->name('records_create');






