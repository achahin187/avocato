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

Route::middleware(['roles:1,2,3'])->group(function () {

Route::get('/issues_types', 'IssuesTypesController@index')->name('issues_types');
Route::post('/issues_types_store', 'IssuesTypesController@store')->name('issues_types_store');
Route::post('/issues_types_destroy/{id}', 'IssuesTypesController@destroy')->name('issues_types_destroy');
Route::post('/issues_types_destroy_all', 'IssuesTypesController@destroy_all')->name('issues_types_destroy_all');
Route::get('/issues_types_excel', 'IssuesTypesController@excel')->name('issues_types_excel');

Route::get('/governorates_cities', 'GovernoratesCitiesController@index')->name('governorates_cities');
Route::post('/governorates_cities/addGovernment', 'GovernoratesCitiesController@storeGovernment')->name('governoratesCities.addGovernment');
Route::post('/governorates_cities/addCity', 'GovernoratesCitiesController@storeCity')->name('governoratesCities.addCity');
Route::get('/governorates_cities/destroy/{id}', 'GovernoratesCitiesController@destroy')->name('governorates_cities.destroy');
Route::get('/governorates_cities/destroySelected', 'GovernoratesCitiesController@destroySelected')->name('governorates_cities.destroySelected');
Route::get('/governorates_cities/exportXLS', 'GovernoratesCitiesController@exportXLS')->name('governorates_cities.exportXLS');

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
Route::get('/consultations_classification/destroySelected', 'ConsultationsClassificationController@destroySelected')->name('consult.destroySelected');
Route::get('/consultations_classification/destroy/{id}', 'ConsultationsClassificationController@destroy')->name('consult.deleteRecord');
Route::get('/consultations_classification/exportXLS', 'ConsultationsClassificationController@exportXLS')->name('consult.exportXLS');

Route::get('/about', 'AboutController@index')->name('about');
Route::get('/about_edit', 'AboutController@edit')->name('about_edit');
Route::patch('/about_edit', 'AboutController@update')->name('about.update');

});



Route::middleware(['roles:1,2,3'])->group(function () {

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

});


Route::middleware(['roles:1'])->group(function () {

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

});


Route::middleware(['roles:1,2'])->group(function () {

Route::get('/news_list', 'NewsListController@index')->name('news_list');
Route::post('/news_list', 'NewsListController@filter')->name('news.filter');
Route::get('/news_list_show/{id}', 'NewsListController@show')->name('news.view');
Route::get('/news_list_create', 'NewsListController@create')->name('news_list_create');
Route::post('/news_list_create', 'NewsListController@store')->name('news.store');
Route::get('/news_list_edit/{id}', 'NewsListController@edit')->name('news.edit');
Route::post('/news_list_update/{id}', 'NewsListController@update')->name('news.update');
Route::get('/news_list/destroy/{id}', 'NewsListController@destroy')->name('news_destroy');
Route::get('/news_list/destroySelected', 'NewsListController@destroySelected')->name('news_destroySelected');
Route::get('/news_list/exportXLS', 'NewsListController@exportXLS')->name('news.exportXLS');

});


Route::middleware(['roles:1,2'])->group(function () {

Route::get('/clients', 'ClientsController@index')->name('clients');
Route::get('/clients/print/{ids}', 'ClientsController@printSelected')->name('printUsers');
Route::get('/clients/export/excel', 'ClientsController@exportXLS')->name('clients.exportXLS');
Route::get('/clients/export/pdf', 'ClientsController@exportPDF')->name('clients.exportPDF');
Route::get('/clients/activate/{id}', 'ClientsController@activate')->name('clients.activate');

Route::get('/individuals', 'IndividualsController@index')->name('ind');
Route::get('/individuals/show/{id}', 'IndividualsController@show')->name('ind.show');
Route::get('/individuals/create', 'IndividualsController@create')->name('ind.create');
Route::post('/individuals/store', 'IndividualsController@store')->name('ind.store');
Route::get('/individuals/edit/{id}', 'IndividualsController@edit')->name('ind.edit');
Route::post('/individuals/ins_update/{id}', 'IndividualsController@ins_update')->name('ind.ins_update');
Route::post('/individuals/update/{id}', 'IndividualsController@update')->name('ind.update');
Route::get('/individuals/destroySelected', 'IndividualsController@destroySelected')->name('ind.destroySelected');
Route::get('/individuals/destroy/{id}', 'IndividualsController@destroy')->name('ind.deleteRecord');
Route::post('/individuals/filter', 'IndividualsController@filter')->name('ind.filter');
Route::get('/individuals/destroyShow/{id}', 'IndividualsController@destroyShow')->name('ind.destroyShow');

Route::get('/companies', 'CompaniesController@index')->name('companies');
Route::get('/companies_show/{id}', 'CompaniesController@show')->name('companies.show');
Route::get('/companies_create', 'CompaniesController@create')->name('companies.create');
Route::get('/companies_edit/{id}', 'CompaniesController@edit')->name('companies.edit');
Route::post('/companies/comp_update/{id}', 'CompaniesController@comp_update')->name('companies.comp_update');
Route::post('/companies/update/{id}', 'CompaniesController@update')->name('companies.update');
Route::post('/companies/store', 'CompaniesController@store')->name('companies.store');
Route::get('/companies/destroy/{id}', 'CompaniesController@destroy')->name('companies.destroy');
Route::get('/companies/destroySelected', 'CompaniesController@destroySelected')->name('company.destroySelected');
Route::post('/companies/filter-companies', 'CompaniesController@filter')->name('company.filter');
Route::get('/companies/destroyShow/{id}', 'CompaniesController@destroyShow')->name('companies.destroyShow');

Route::get('/individuals_companies', 'IndividualsCompaniesController@index')->name('ind.com');
Route::get('/individuals_companies_show/{id}', 'IndividualsCompaniesController@show')->name('ind.com.show');
Route::get('/individuals_companies_create', 'IndividualsCompaniesController@create')->name('ind.com.create');
Route::post('/individuals_companies_store', 'IndividualsCompaniesController@store')->name('ind.com.store');
Route::get('/individuals_companies_edit/{id}', 'IndividualsCompaniesController@edit')->name('ind.com.edit');
Route::post('/individuals_companies/ind_comp_update/{id}', 'IndividualsCompaniesController@ind_comp_update')->name('ind_comp_update');
Route::post('/individuals_companies/update/{id}', 'IndividualsCompaniesController@update')->name('ind.com.update');
Route::get('/individuals_companies/destroy/{id}', 'IndividualsCompaniesController@destroy')->name('ind.com.destroy');
Route::get('/individuals_companies/destroySelected', 'IndividualsCompaniesController@destroySelected')->name('ind.com.destroySelected');
Route::post('/individuals_companies/filter', 'IndividualsCompaniesController@filter')->name('ind.com.filter');
Route::get('/individuals_companies/destroyShow/{id}', 'IndividualsCompaniesController@destroyShow')->name('ind.com.destroyShow');

Route::get('/mobile', 'MobileController@index')->name('mobile');
Route::get('/mobile_show/{id}', 'MobileController@show')->name('mobile.show');
Route::post('/mobile/exportXLS', 'MobileController@exportXLS')->name('mobile.exportXLS');
Route::get('/mobile/destroySelected', 'MobileController@destroySelected')->name('mobile.destroySelected');
Route::get('/mobile/destroy/{id}', 'MobileController@destroy')->name('mobile.destroy');
Route::post('/mobile/filter', 'MobileController@filter')->name('mobile.filter');


Route::get('/notifications', 'NotificationsController@index')->name('notifications');
Route::post('/notifications_store', 'NotificationsController@store')->name('notifications.store');
Route::post('/notifications_destroy/{id}', 'NotificationsController@destroy')->name('notifications.destroy');
Route::get('/notifications_cron', 'NotificationsController@notification_cron')->name('notifications.cron');
Route::post('/notifications_change/{id}', 'NotificationsController@change')->name('notifications.change');

});



Route::middleware(['roles:1,2,3,4'])->group(function () {

Route::get('/complains', 'ComplainsController@index')->name('complains');
Route::get('/complains/edit/{id}', 'ComplainsController@edit')->name('complains.edit');
Route::post('/complains/add/reply/{id}', 'ComplainsController@update')->name('complains.addReply');
Route::get('/complains/destroySelected', 'ComplainsController@destroySelected')->name('complains.destroySelected');
Route::get('/complains/destroy/{id}', 'ComplainsController@destroy')->name('complains.destroy');
Route::post('/complains/filter', 'ComplainsController@filter')->name('complains.filter');

});


Route::middleware(['roles:1,2,3'])->group(function () {

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
Route::post('/lawyers_rate/{id}', 'LawyersController@rate')->name('lawyers_rate');

});



Route::middleware(['roles:1,2'])->group(function () {

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
Route::post('/legal_consultation_filter', 'LegalConsultationsController@consultations_filter')->name('legal_consultation_filter');
Route::post('/set_perfect_response', 'LegalConsultationsController@set_perfect_response')->name('set_perfect_response');
Route::post('/lawyers_consultation_filter/{id}', 'LegalConsultationsController@lawyers_filter')->name('lawyers_consultation_filter');
Route::get('/consultations_excel', 'LegalConsultationsController@excel')->name('consultations_excel');
});


Route::middleware(['roles:1,2,3'])->group(function () {

Route::get('/cases', 'CasesController@index')->name('cases');
Route::get('/case_view/{id}', 'CasesController@show')->name('case_view');
Route::get('/case_archive_view/{id}', 'CasesController@archive_show')->name('case_archive_view');
Route::get('/case_add', 'CasesController@create')->name('case_add');
Route::get('/case_edit/{id}', 'CasesController@edit')->name('case_edit');
Route::post('/add_new_case', 'CasesController@add')->name('add_new_case');
Route::post('/lawyers_cases_filter', 'CasesController@lawyers_filter')->name('lawyers_cases_filter');
Route::post('/change_case_state/{id}', 'CasesController@change_case_state')->name('change_case_state');
Route::get('/case_destroy/{id}', 'CasesController@destroy')->name('case_destroy');
Route::post('/case_destroy_all', 'CasesController@destroy_all')->name('case_destroy_all');
Route::post('/case_add_session/{id}', 'CasesController@add_session')->name('case_add_session');
Route::post('/case_add_record/{id}', 'CasesController@add_record')->name('case_add_record');
Route::post('/add_record_ajax/{id}', 'CasesController@add_record_ajax')->name('add_record_ajax');
Route::get('/case_record_destroy/{id}/{record_id}', 'CasesController@destroy_record')->name('case_record_destroy');
Route::get('/download_document/{id}', 'CasesController@download_document')->name('download_document');
Route::get('/download_all_documents/{id}', 'CasesController@download_all_documents')->name('download_all_documents');
Route::post('/edit_case/{id}', 'CasesController@edit_case')->name('edit_case');
Route::post('/filter_cases', 'CasesController@filter_cases')->name('filter_cases');
Route::get('/cases_excel', 'CasesController@excel')->name('cases_excel');

});


Route::middleware(['roles:1,2,3'])->group(function () {

Route::get('/services', 'ServicesController@index')->name('services');
Route::get('/services_show/{id}', 'ServicesController@show')->name('services_show');
Route::post('/services_status/{id}', 'ServicesController@status')->name('services_status');
Route::post('/services_charge/{id}', 'ServicesController@charge')->name('services_charge');
Route::post('/charge_status/{id}', 'ServicesController@charge_status')->name('charge_status');
Route::post('/charge_destroy/{id}', 'ServicesController@charge_destroy')->name('charge_destroy');
Route::get('/services_create', 'ServicesController@create')->name('services_create');
Route::post('/services_store', 'ServicesController@store')->name('services_store');
Route::get('/services_edit/{id}', 'ServicesController@edit')->name('services_edit');
Route::post('/services_update/{id}', 'ServicesController@update')->name('services_update');
Route::get('/services_excel', 'ServicesController@excel')->name('services_excel');
Route::get('/services_excel2', 'ServicesController@excel2')->name('services_excel2');
Route::post('/services_filter', 'ServicesController@filter')->name('services_filter');
Route::post('/services_filter2', 'ServicesController@filter2')->name('services_filter2');
Route::post('/services_destroy/{id}', 'ServicesController@destroy')->name('services_list_destroy');
Route::post('/services_destroy_all', 'ServicesController@destroy_all')->name('services_destroy_all');
Route::get('/report_download_document/{id}', 'ServicesController@download_document')->name('report_download_document');
Route::get('/report_download_all_documents/{id}', 'ServicesController@download_all_documents')->name('report_download_all_documents');
Route::get('/services_lawyer/{id}', 'ServicesController@lawyer')->name('services_lawyer');
Route::get('/services_lawyer_task/{id}', 'ServicesController@lawyer_task')->name('services_lawyer_task');
Route::post('/services_lawyer_assign/{id}', 'ServicesController@assign')->name('services_lawyer_assign');
Route::post('/services_lawyer_filter/{id}', 'ServicesController@filter_lawyer')->name('services_lawyer_filter');

});



Route::middleware(['roles:1,2'])->group(function () {

Route::get('/tasks_normal', 'TasksController@normal_index')->name('tasks_normal');
Route::post('/session_destroy/{id}', 'TasksController@destroy')->name('session_destroy');
Route::post('/session_destroy_all', 'TasksController@destroy_all')->name('session_destroy_all');
Route::get('/session_excel', 'TasksController@excel')->name('session_excel');
Route::post('/session_filter', 'TasksController@filter')->name('session_filter');

});




Route::middleware(['roles:1,2,4'])->group(function () {


Route::get('/tasks_emergency', 'TasksController@emergency_index')->name('tasks_emergency');
Route::get('/task_emergency_view/{id}', 'EmergencyTasksController@view')->name('task_emergency_view');
Route::post('/change_task_state/{id}', 'EmergencyTasksController@change_task_state')->name('change_task_state');
Route::post('/task_destroy_all', 'EmergencyTasksController@task_destroy_all')->name('task_destroy_all');
Route::get('/task_destroy/{id}', 'EmergencyTasksController@task_destroy')->name('task_destroy');
Route::post('/add_emergency_task', 'EmergencyTasksController@add_emergency_task')->name('add_emergency_task');
Route::get('/assign_emergency_task/{id}', 'EmergencyTasksController@assign_emergency_task')->name('assign_emergency_task');
Route::post('/assign_lawyer_emergency_task/{id}', 'EmergencyTasksController@assign_lawyer_emergency_task')->name('assign_lawyer_emergency_task');
Route::get('/emergency_lawyer_task/{id}/{task_id}', 'ServicesController@lawyer_task')->name('emergency_lawyer_task');
Route::post('/emergency_lawyer_assign_filter/{task_id}', 'EmergencyTasksController@emergency_lawyer_assign_filter')->name('emergency_lawyer_assign_filter');
Route::get('/emergencytasks_excel', 'EmergencyTasksController@excel')->name('emergencytasks_excel');

});



Route::middleware(['roles:1'])->group(function () {

Route::get('/reports_statistics', 'ReportsStatisticsController@index')->name('reports_statistics');
Route::post('/reports_statistics/filter', 'ReportsStatisticsController@filter')->name('report.filter');

});


    Route::middleware(['roles:1,2,3,4'])->group(function () {
        Route::get('/records', 'RecordsController@index')->name('records');
Route::get('/records/create', 'RecordsController@create')->name('records.add');
Route::post('/records/store', 'RecordsController@store')->name('record.store');
Route::get('/records/destroySelected', 'RecordsController@destroySelected')->name('records.destroySelected');
Route::get('/records/destroy/{id}', 'RecordsController@destroy')->name('records.deleteRecord');
Route::post('/records/filter', 'RecordsController@filter')->name('records.filter');
    });


Route::get('/home', 'HomeController@index')->name('home');







});

Route::get('/Landing/{lang}', 'LandingController@index')->name('landing');
Route::post('/Landing/ind', 'LandingController@ind')->name('landing.ind');
Route::post('/Landing/lawyer', 'LandingController@lawyer')->name('landing.lawyer');
Route::post('/Landing/office', 'LandingController@office')->name('landing.office');
