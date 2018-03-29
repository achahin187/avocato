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
Auth::routes();

Route::group(['middleware' => ['auth']], function () {



Route::get('/', 'HomeController@index')->name('home');

Route::get('/issues_types', 'IssuesTypesController@index')->name('issues_types');
Route::post('/issues_types_store', 'IssuesTypesController@store')->name('issues_types_store');
Route::post('/issues_types_destroy/{id}', 'IssuesTypesController@destroy')->name('issues_types_destroy');
Route::post('/issues_types_destroy_all', 'IssuesTypesController@destroy_all')->name('issues_types_destroy_all');
Route::get('/issues_types_excel', 'IssuesTypesController@excel')->name('issues_types_excel');

Route::get('/governorates_cities', 'GovernoratesCitiesController@index')->name('governorates_cities');
Route::post('/governorates_cities/addGovernment', 'GovernoratesCitiesController@storeGovernment')->name('governoratesCities.addGovernment');
Route::post('/governorates_cities/addCity', 'GovernoratesCitiesController@storeCity')->name('governoratesCities.addCity');
Route::delete('/governorates_cities/destroy/{id}', 'GovernoratesCitiesController@destroy')->name('governorates_cities.destroy');
Route::delete('/governorates_cities/destroySelected', 'GovernoratesCitiesController@destroySelected')->name('governorates_cities.destroySelected');
Route::post('/governorates_cities/exportXLS', 'GovernoratesCitiesController@exportXLS')->name('governorates_cities.exportXLS');

Route::get('/courts_list', 'CourtsListController@index')->name('courts_list');
Route::get('/courts_get_city', 'CourtsListController@getCity')->name('courts_get_city');
Route::post('/courts_list_store', 'CourtsListController@store')->name('courts_list_store');
Route::post('/courts_list_destroy/{id}', 'CourtsListController@destroy')->name('courts_list_destroy');
Route::post('/courts_list_destroy_all', 'CourtsListController@destroy_all')->name('courts_list_destroy_all');
Route::get('/courts_list_excel', 'CourtsListController@excel')->name('courts_list_excel');

Route::get('/contracts_formulas_types', 'ContractsFormulasTypesController@index')->name('contracts_formulas_types');
Route::post('/contracts_formulas_types_store', 'ContractsFormulasTypesController@store')->name('contracts_formulas_types_store');
Route::post('/contracts_formulas_types_store_sub', 'ContractsFormulasTypesController@store_sub')->name('contracts_formulas_types_store_sub');
Route::post('/contracts_formulas_types_destroy/{id}', 'ContractsFormulasTypesController@destroy')->name('contracts_formulas_types_destroy');
Route::post('/contracts_formulas_types_destroy_all', 'ContractsFormulasTypesController@destroy_all')->name('contracts_formulas_types_destroy_all');
Route::get('/contracts_formulas_types_excel', 'ContractsFormulasTypesController@excel')->name('contracts_formulas_types_excel');

Route::get('/consultations_classification', 'ConsultationsClassificationController@index')->name('consultations_classification');
Route::post('/consultations_classification', 'ConsultationsClassificationController@store')->name('consult.store');
Route::delete('/consultations_classification/destroySelected', 'ConsultationsClassificationController@destroySelected')->name('consult.destroySelected');
Route::delete('/consultations_classification/destroy/{id}', 'ConsultationsClassificationController@destroy')->name('consult.deleteRecord');
Route::post('/consultations_classification/exportXLS', 'ConsultationsClassificationController@exportXLS')->name('consult.exportXLS');

Route::get('/about', 'AboutController@index')->name('about');
Route::get('/about_edit', 'AboutController@edit')->name('about_edit');
Route::patch('/about_edit', 'AboutController@update')->name('about.update');

Route::get('/formulas', 'FormulasController@index')->name('formulas');
Route::get('/formulas_create', 'FormulasController@create')->name('formulas_create');
Route::get('/formulas_get_sub', 'FormulasController@getSub')->name('formulas_get_sub');
Route::post('/formulas_store', 'FormulasController@store')->name('formulas_store');
Route::get('/formulas_edit/{id}', 'FormulasController@edit')->name('formulas_edit');
Route::post('/formulas_update/{id}', 'FormulasController@update')->name('formulas_update');
Route::post('/formulas_destroy/{id}', 'FormulasController@destroy')->name('formulas_destroy');
Route::post('/formulas_destroy_all', 'FormulasController@destroy_all')->name('formulas_destroy_all');
Route::get('/formulas_excel', 'FormulasController@excel')->name('formulas_excel');
Route::post('/formulas_filter', 'FormulasController@filter')->name('formulas_filter');
Route::get('/formulas_get_subs', 'FormulasController@getSubs')->name('formulas_get_subs');

Route::get('/users_list', 'UsersListController@index')->name('users_list');
Route::get('/user_profile/{id}', 'UsersListController@show')->name('user_profile');
Route::get('/users_list_create', 'UsersListController@create')->name('users_list_create');
Route::post('/users_list_store', 'UsersListController@store')->name('users_list_store');
Route::get('/users_list_edit/{id}', 'UsersListController@edit')->name('users_list_edit');
Route::post('/users_list_update/{id}', 'UsersListController@update')->name('users_list_update');
Route::get('/users_list_destroy_get/{id}', 'UsersListController@destroyGet')->name('users_list_destroy_get');
Route::post('/users_list_destroy_post/{id}', 'UsersListController@destroyPost')->name('users_list_destroy_post');
Route::post('/users_list_destroy_all', 'UsersListController@destroy_all')->name('users_list_destroy_all');
Route::get('/users_list_excel', 'UsersListController@excel')->name('users_list_excel');
Route::post('/users_list_filter', 'UsersListController@filter')->name('users_list_filter');

Route::get('/news_list', 'NewsListController@index')->name('news_list');
Route::post('/news_list', 'NewsListController@filter')->name('news.filter');
Route::get('/news_list_show/{id}', 'NewsListController@show')->name('news.view');
Route::get('/news_list_create', 'NewsListController@create')->name('news_list_create');
Route::post('/news_list_create', 'NewsListController@store')->name('news.store');
Route::get('/news_list_edit/{id}', 'NewsListController@edit')->name('news.edit');
Route::post('/news_list_update/{id}', 'NewsListController@update')->name('news.update');
Route::delete('/news_list/destroy/{id}', 'NewsListController@destroy')->name('news_destroy');
Route::delete('/news_list/destroySelected', 'NewsListController@destroySelected')->name('news_destroySelected');
Route::post('/news_list/exportXLS', 'NewsListController@exportXLS')->name('news.exportXLS');


Route::get('/clients', 'ClientsController@index')->name('clients');

Route::get('/individuals', 'IndividualsController@index')->name('ind');
Route::get('/individuals/show', 'IndividualsController@show')->name('ind.show');
Route::get('/individuals/create', 'IndividualsController@create')->name('ind.create');
Route::post('/individuals/store', 'IndividualsController@store')->name('ind.store');
Route::get('/individuals/edit', 'IndividualsController@edit')->name('ind.edit');
Route::delete('/individuals/destroy/{id}', 'IndividualsController@destroy')->name('ind.destroy');
Route::delete('/individuals/destroySelected', 'IndividualsController@destroySelected')->name('ind.destroySelected');

Route::get('/companies', 'CompaniesController@index')->name('companies');
Route::get('/companies_show', 'CompaniesController@show')->name('companies.show');
Route::get('/companies_create', 'CompaniesController@create')->name('companies.create');
Route::get('/companies_edit', 'CompaniesController@edit')->name('companies.edit');
Route::post('/companies_store', 'CompaniesController@store')->name('companies.store');
Route::delete('/companies/destroy/{id}', 'CompaniesController@destroy')->name('companies.destroy');
Route::delete('/companies/destroySelected', 'CompaniesController@destroySelected')->name('company.destroySelected');

Route::get('/individuals_companies', 'IndividualsCompaniesController@index')->name('ind.com');
Route::get('/individuals_companies_show', 'IndividualsCompaniesController@show')->name('ind.com.show');
Route::get('/individuals_companies_create', 'IndividualsCompaniesController@create')->name('ind.com.create');
Route::post('/individuals_companies_store', 'IndividualsCompaniesController@store')->name('ind.com.store');
Route::get('/individuals_companies_edit', 'IndividualsCompaniesController@edit')->name('ind.com.edit');
Route::delete('/individuals_companies/destroy/{id}', 'IndividualsCompaniesController@destroy')->name('ind.com.destroy');
Route::delete('/individuals_companies/destroySelected', 'IndividualsCompaniesController@destroySelected')->name('ind.com.destroySelected');

Route::get('/mobile', 'MobileController@index')->name('mobile');
Route::get('/mobile_show', 'MobileController@show')->name('mobile_show');
Route::post('/mobile/exportXLS', 'MobileController@exportXLS')->name('mobile.exportXLS');
Route::delete('/mobile/destroySelected', 'MobileController@destroySelected')->name('mobile.destroySelected');
Route::delete('/mobile/destroy/{id}', 'MobileController@destroy')->name('mobile.destroy');

Route::get('/notifications', 'NotificationsController@index')->name('notifications');

Route::get('/complains', 'ComplainsController@index')->name('complains');
Route::get('/complains_edit', 'ComplainsController@edit')->name('complains_edit');

Route::get('/lawyers', 'LawyersController@index')->name('lawyers');
Route::get('/lawyers_follow', 'LawyersController@follow')->name('lawyers_follow');
Route::get('/lawyers_show/{id}', 'LawyersController@show')->name('lawyers_show');
Route::get('/lawyers_create', 'LawyersController@create')->name('lawyers_create');
Route::post('/lawyers_store', 'LawyersController@store')->name('lawyers_store');
Route::get('/lawyers_edit/{id}', 'LawyersController@edit')->name('lawyers_edit');
Route::post('/lawyers_update/{id}', 'LawyersController@update')->name('lawyers_update');
Route::get('/lawyers_destroy_get/{id}', 'LawyersController@destroyGet')->name('lawyers_destroy_get');
Route::post('/lawyers_destroy_post/{id}', 'LawyersController@destroyPost')->name('lawyers_destroy_post');
Route::post('/lawyers_destroy_all', 'LawyersController@destroy_all')->name('lawyers_destroy_all');
Route::get('/lawyers_excel', 'LawyersController@excel')->name('lawyers_excel');
Route::post('/lawyers_filter', 'LawyersController@filter')->name('lawyers_filter');

Route::get('/legal_consultations', 'LegalConsultationsController@index')->name('legal_consultations');
Route::get('/legal_consultations_show', 'LegalConsultationsController@show')->name('legal_consultations_show');
Route::get('/legal_consultation_add', 'LegalConsultationsController@add')->name('legal_consultation_add');
Route::get('/legal_consultation_edit/{id}', 'LegalConsultationsController@edit')->name('legal_consultation_edit');
Route::get('/legal_consultation_assign/{id}', 'LegalConsultationsController@assign')->name('legal_consultation_assign');

Route::post('/legal_consultation_store', 'LegalConsultationsController@store')->name('legal_consultation_store');
Route::get('/legal_consultation_view/{id}', 'LegalConsultationsController@view')->name('legal_consultation_view');
Route::post('/edit_lawyer_response', 'LegalConsultationsController@edit_lawyer_response')->name('edit_lawyer_response');
Route::post('/delete_lawyer_response', 'LegalConsultationsController@delete_lawyer_response')->name('delete_lawyer_response');
Route::post('/legal_edit_consultation/{id}', 'LegalConsultationsController@edit_consultation')->name('legal_edit_consultation');
Route::get('/legal_consultation_destroy/{id}', 'LegalConsultationsController@destroy')->name('legal_consultation_destroy');
Route::post('/legal_consultation_destroy_all', 'LegalConsultationsController@destroy_all')->name('legal_consultation_destroy_all');
Route::post('/send_consultation_to_all_lawyers/{consultation_id}', 'LegalConsultationsController@send_consultation_to_all_lawyers')->name('send_consultation_to_all_lawyers');
Route::post('/legal_consultation_filter', 'LegalConsultationsController@filter')->name('legal_consultation_filter');

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








Route::get('/home', 'HomeController@index')->name('home');







});
