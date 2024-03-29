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

// Auth::routes();
Route::get('/choose_country', 'GeoCountryController@index')->name('choose.country');
Route::post('/choose_country_info', 'GeoCountryController@choose')->name('choose.country.info');
Route::group(['middleware' => ['country']], function () {
    Route::get('/login', '\App\Http\Controllers\Auth\LoginController@authenticate')->name('login');
    Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login')->name('auth.login');
    Route::group(['middleware' => ['auth']], function () {

        Route::post('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

        // Route::get('/', 'HomeController@index')->name('home');
        Route::get('/', 'ReportsStatisticsController@index')->name('home');

        Route::middleware(['roles:1,2,3'])->group(function () {
            Route::post('/add_task_report/{id}', 'EmergencyTasksController@add_task_report')->name('add_task_report');
            Route::get('/issues_types', 'IssuesTypesController@index')->name('issues_types');
            Route::post('/issues_types_store', 'IssuesTypesController@store')->name('issues_types_store');
            Route::post('/issues_types_destroy/{id}', 'IssuesTypesController@destroy')->name('issues_types_destroy');
            Route::post('/issues_types_destroy_all', 'IssuesTypesController@destroy_all')->name('issues_types_destroy_all');
            Route::get('/issues_types_excel', 'IssuesTypesController@excel')->name('issues_types_excel');
            Route::post('/issues_types_add_localization', 'IssuesTypesController@add_localization')->name('issues_types_add_localization');
            Route::post('/change.language', 'IssuesTypesController@changeLanguage')->name('change.language');
            //
            Route::get('/specializations', 'SpecializationsController@index')->name('specializations');
            Route::post('/specializations_store', 'SpecializationsController@store')->name('specializations_store');
            Route::post('/specializations_destroy/{id}', 'SpecializationsController@destroy')->name('specializations_destroy');
            Route::post('/specializations_destroy_all', 'SpecializationsController@destroy_all')->name('specializations_destroy_all');
            Route::get('/specializations_excel', 'SpecializationsController@excel')->name('specializations_excel');
            Route::post('/specialization_add_localization', 'SpecializationsController@add_localization')->name('specialization_add_localization');


            Route::get('/governorates_cities', 'GovernoratesCitiesController@index')->name('governorates_cities');
            Route::post('/governorates_cities/addGovernment', 'GovernoratesCitiesController@storeGovernment')->name('governoratesCities.addGovernment');
            Route::post('/governorates_cities/addCity', 'GovernoratesCitiesController@storeCity')->name('governoratesCities.addCity');
            Route::post('/governorates_cities/destroy_governate', 'GovernoratesCitiesController@destroy_governate')->name('governorates_cities.destroy_governate');
            Route::post('/governorates_cities/destroy_city', 'GovernoratesCitiesController@destroy_city')->name('governorates_cities.destroy_city');
            Route::post('/governorates_cities/destroyAllgovernate', 'GovernoratesCitiesController@destroyAllgovernate')->name('governorates_cities.destroyAllgovernate');
            Route::post('/governorates_cities/destroyAllcity', 'GovernoratesCitiesController@destroyAllcity')->name('governorates_cities.destroyAllcity');
            Route::get('/governorates_cities/exportXLS', 'GovernoratesCitiesController@exportXLS')->name('governorates_cities.exportXLS');
            Route::post('/governorates_cities/add_localization', 'GovernoratesCitiesController@add_localization')->name('governorates_cities_add_localization');
            Route::post('/governorates_cities/government_localization', 'GovernoratesCitiesController@government_localization')->name('governorates_cities.government_localization');

            Route::get('/courts_list', 'CourtsListController@index')->name('courts_list');
            Route::get('/courts_get_city', 'CourtsListController@getCity')->name('courts_get_city');
            Route::post('/courts_list_store', 'CourtsListController@store')->name('courts_list_store');
            Route::post('/courts_list_destroy/{id}', 'CourtsListController@destroy')->name('courts_list_destroy');
            Route::post('/courts_list_destroy_all', 'CourtsListController@destroy_all')->name('courts_list_destroy_all');
            Route::post('/courts_list_excel', 'CourtsListController@excel')->name('courts_list_excel');
            Route::post('/courts_list/add_localization', 'CourtsListController@add_localization')->name('courts_list_add_localization');

            Route::get('/contracts_formulas_types', 'ContractsFormulasTypesController@index')->name('contracts_formulas_types');
            Route::post('/contracts_formulas_types_store', 'ContractsFormulasTypesController@store')->name('contracts_formulas_types_store');
            Route::post('/contracts_formulas_types_store_sub', 'ContractsFormulasTypesController@store_sub')->name('contracts_formulas_types_store_sub');
            Route::post('/contracts_formulas_main_type_destroy/{id}', 'ContractsFormulasTypesController@main_type_destroy')->name('contracts_formulas_main_type_destroy');
            Route::post('/contracts_formulas_main_type_destroyAll', 'ContractsFormulasTypesController@main_type_destroyAll')->name('contracts_formulas_main_type_destroyAll');
            Route::post('/contracts_formulas_sub_type_destroy/{id}', 'ContractsFormulasTypesController@sub_type_destroy')->name('contracts_formulas_sub_type_destroy');
            Route::post('/contracts_formulas_sub_type_destroyAll', 'ContractsFormulasTypesController@sub_type_destroyAll')->name('contracts_formulas_sub_type_destroyAll');
            Route::post('/contracts_formulas_types_main_excel', 'ContractsFormulasTypesController@main_excel')->name('contracts_formulas_types_main_excel');
            Route::get('/contracts_formulas_types_sub_excel', 'ContractsFormulasTypesController@sub_excel')->name('contracts_formulas_types_sub_excel');
            Route::post('/contracts_formulas_types/main_type_localization', 'ContractsFormulasTypesController@main_type_localization')->name('contracts_formulas_main_type_localization');
            Route::post('/contracts_formulas_types/sub_type_localization', 'ContractsFormulasTypesController@sub_type_localization')->name('contracts_formulas_sub_type_localization');
            Route::get('/rename_files', 'ContractsFormulasTypesController@rename_files')->name('rename_files');

            Route::get('/consultations_classification', 'ConsultationsClassificationController@index')->name('consultations_classification');
            Route::post('/consultations_classification', 'ConsultationsClassificationController@store')->name('consult.store');
            Route::post('/consultations_classification/update', 'ConsultationsClassificationController@update')->name('consult.update');
            Route::post('/consultations_classification/destroySelected', 'ConsultationsClassificationController@destroySelected')->name('consult.destroySelected');
            Route::get('/consultations_classification/destroy/{id}', 'ConsultationsClassificationController@destroy')->name('consult.deleteRecord');
            Route::get('/consultations_classification/exportXLS', 'ConsultationsClassificationController@exportXLS')->name('consult.exportXLS');
            Route::post('/consultations_classification/add_localization', 'ConsultationsClassificationController@add_localization')->name('consultations_classification_add_localization');

            Route::group(['prefix' => 'academic_degrees'], function () {
                Route::get('/', 'AcademicDegreeController@index')->name('degrees');
                Route::get('/create', 'AcademicDegreeController@create')->name('degrees.create');
                Route::post('/store', 'AcademicDegreeController@store')->name('degrees.store');
                Route::get('/edit/{id}', 'AcademicDegreeController@edit')->name('degrees.edit');
                Route::post('/update/{id}', 'AcademicDegreeController@update')->name('degrees.update');
                Route::post('/destroy/{id}', 'AcademicDegreeController@destroy')->name('degrees.destroy');
                Route::post('/destroyall', 'AcademicDegreeController@destroyall')->name('degrees.destroyall');
                Route::post('/add_localization', 'AcademicDegreeController@add_localization')->name('degrees.add_localization');
            });

            Route::get('/about', 'AboutController@index')->name('about');
            Route::get('/about_edit', 'AboutController@edit')->name('about_edit');
            Route::patch('/about_edit', 'AboutController@update')->name('about.update');
            Route::get('/aboutUsAjax/{lang_id}', 'AboutController@aboutUsAjax')->name('aboutUsAjax');
            Route::get('/missionAjax/{lang_id}', 'AboutController@missionAjax')->name('missionAjax');
            Route::get('/visionAjax/{lang_id}', 'AboutController@visionAjax')->name('visionAjax');
            Route::get('/termsAjax/{lang_id}', 'AboutController@termsAjax')->name('termsAjax');
            Route::get('/privacyAjax/{lang_id}', 'AboutController@privacyAjax')->name('privacyAjax');

            //terms and conditions
            Route::get('/terms_conditions', 'AboutController@terms_conditions')->name('terms_conditions');
            Route::get('/terms_edit', 'AboutController@terms_edit')->name('terms_edit');
            Route::patch('/terms_edit', 'AboutController@terms_update')->name('terms.update');

            //privacy
            Route::get('/privacy', 'AboutController@privacy')->name('privacy');
            Route::get('/privacy_edit', 'AboutController@privacy_edit')->name('privacy_edit');
            Route::patch('/privacy_edit', 'AboutController@privacy_update')->name('privacy.update');

            //bouquets
            Route::get('/bouquets', 'BouquetsController@index')->name('bouquets');
            Route::get('/bouquets_view/{id}', 'BouquetsController@view')->name('bouquets.view');
            Route::get('/bouquets_edit/{id}', 'BouquetsController@edit')->name('bouquets.edit');
            Route::post('/bouquets_update/{id}', 'BouquetsController@update')->name('bouquets.update');
            Route::get('/bouquets_delete/{id}', 'BouquetsController@delete')->name('bouquets.delete');
            Route::post('/bouquets_delete_all', 'BouquetsController@delete_all')->name('bouquets.delete_all');
            Route::get('/bouquets_add', 'BouquetsController@add')->name('bouquets.add');
            Route::post('/bouquets_create', 'BouquetsController@create')->name('bouquets.create');
            Route::post('/bouquets_add_localization', 'BouquetsController@add_localization')->name('bouquets.add_localization');
            Route::post('/bouquets_payment_user_update/{id}', 'BouquetsController@bouquets_payment_user_update')->name('bouquets_payment_user.update');
            Route::get('/bouquet_payment/{id}', 'BouquetsController@bouquet_payment')->name('bouquet.payment');
            Route::get('/bouquet_payment_value/{id}/{discount}', 'BouquetsController@bouquet_payment_value')->name('bouquet.payment.value');
            Route::get('/bouquet_price/{id}', 'BouquetsController@bouquet_price')->name('bouquet.price');
            Route::get('/bouquet_price_value/{id}/{discount}/{price_relation}', 'BouquetsController@bouquet_price_value')->name('bouquet.price.value');
            Route::get('/bouquet_type/{id}', 'BouquetsController@bouquet_type')->name('bouquet.type');
            Route::get('/bouquets/excel', 'BouquetsController@excel')->name('bouquets.excel');
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
            Route::match(['get', 'post'], '/users_list_filter', 'UsersListController@filter')->name('users_list_filter');
            Route::post('/filter_logs/{id}', 'UsersListController@filter_logs')->name('filter_logs');
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
            Route::get('/news_list/rename_files', 'NewsListController@rename_files')->name('news.rename_files');
        });


        Route::middleware(['roles:1,2'])->group(function () {

            Route::get('/clients', 'ClientsController@index')->name('clients');
            Route::get('/clients/print/{ids}', 'ClientsController@printSelected')->name('printUsers');
            Route::get('/clients/export/excel', 'ClientsController@exportXLS')->name('clients.exportXLS');
            Route::get('/clients/export/pdf', 'ClientsController@exportPDF')->name('clients.exportPDF');
            Route::get('/clients/activate/{id}', 'ClientsController@activate')->name('clients.activate');

            Route::get('/individuals', 'IndividualsController@index')->name('ind');
            Route::get('/individuals/show/{id}', 'IndividualsController@show')->name('ind.show');
            Route::post('/procuration/store', 'ProcurationsController@store')->name('procuration.store');
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
            Route::match(['get', 'post'], '/mobile/filter', 'MobileController@filter')->name('mobile.filter');


            Route::get('/notifications', 'NotificationsController@index')->name('notifications');
            Route::post('/notifications_store', 'NotificationsController@store')->name('notifications.store');
            Route::get('/notifications_destroy/{id}', 'NotificationsController@destroy')->name('notifications.destroy');
            Route::post('/notifications_change/{id}', 'NotificationsController@change')->name('notifications.change');
            Route::post('/notifications_filter', 'NotificationsController@filter')->name('notifications_filter');
            Route::post('/notification_lawyer/{id}', 'NotificationsController@notification_lawyer')->name('notification_lawyer');
            Route::post('/notification_for_lawyers', 'NotificationsController@notification_for_lawyers')->name('notification_for_lawyers');
        });



        Route::middleware(['roles:1,2,3,4'])->group(function () {

            Route::get('/complains', 'ComplainsController@index')->name('complains');
            Route::get('/complains/edit/{id}', 'ComplainsController@edit')->name('complains.edit');
            Route::post('/complains/add/reply/{id}', 'ComplainsController@update')->name('complains.addReply');
            Route::get('/complains/destroySelected', 'ComplainsController@destroySelected')->name('complains.destroySelected');
            Route::get('/complains/destroy/{id}', 'ComplainsController@destroy')->name('complains.destroy');
            Route::post('/complains/filter', 'ComplainsController@filter')->name('complains.filter');
            Route::get('/complains/export/excel', 'ComplainsController@exportXLS')->name('complains.exportXLS');
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
            Route::match(['get', 'post'], '/lawyers_filter', 'LawyersController@filter')->name('lawyers_filter');
            Route::post('/lawyers_rate/{id}', 'LawyersController@rate')->name('lawyers_rate');
            Route::get('/rate_edit/{id}', 'LawyersController@rate_edit')->name('notes_edit');
            Route::post('/rate_edit_notes', 'LawyersController@rate_edit_notes')->name('notes_edit_admin');
            Route::get('/rate_delete/{id}', 'LawyersController@rate_delete')->name('notes_delete');
            Route::get('/lawyers_activate_deactivate/{id}', 'LawyersController@activateDeactivateLawyer')->name('lawyers_activate');
            Route::post('/lawyers/advertise', 'LawyersController@advertise')->name('lawyers.advertise');
        });



        Route::middleware(['roles:1,2'])->group(function () {

            Route::get('/legal_consultations', 'LegalConsultationsController@index')->name('legal_consultations');
            Route::get('/legal_consultations_show', 'LegalConsultationsController@show')->name('legal_consultations_show');
            Route::get('/legal_consultation_add', 'LegalConsultationsController@add')->name('legal_consultation_add');
            Route::get('/legal_consultation_edit/{id}', 'LegalConsultationsController@edit')->name('legal_consultation_edit');
            Route::get('/legal_consultation_category/{id}', 'LegalConsultationsController@category')->name('legal_consultation_category');
            Route::get('/legal_consultation_assign/{id}', 'LegalConsultationsController@assign')->name('legal_consultation_assign');
            Route::post('/legal_consultation_store', 'LegalConsultationsController@store')->name('legal_consultation_store');
            Route::get('/legal_consultation_view/{id}', 'LegalConsultationsController@view')->name('legal_consultation_view');
            Route::post('/edit_lawyer_response', 'LegalConsultationsController@edit_lawyer_response')->name('edit_lawyer_response');
            Route::post('/delete_lawyer_response', 'LegalConsultationsController@delete_lawyer_response')->name('delete_lawyer_response');
            Route::post('/legal_edit_consultation/{id}', 'LegalConsultationsController@edit_consultation')->name('legal_edit_consultation');
            Route::post('/legal_category_consultation/{id}', 'LegalConsultationsController@category_consultation')->name('legal_category_consultation');
            Route::get('/legal_consultation_destroy/{id}', 'LegalConsultationsController@destroy')->name('legal_consultation_destroy');
            Route::post('/legal_consultation_destroy_all', 'LegalConsultationsController@destroy_all')->name('legal_consultation_destroy_all');
            Route::post('/send_consultation_to_all_lawyers/{consultation_id}', 'LegalConsultationsController@send_consultation_to_all_lawyers')->name('send_consultation_to_all_lawyers');
            Route::match(['get', 'post'], '/legal_consultation_filter', 'LegalConsultationsController@consultations_filter')->name('legal_consultation_filter');
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
            Route::get('/download_case_document/{id}', 'CasesController@download_case_document')->name('download_case_document');
            Route::get('/download_all_documents/{id}', 'CasesController@download_all_documents')->name('download_all_documents');
            Route::get('/download_all_case_documents/{id}', 'CasesController@download_all_case_documents')->name('download_all_case_documents');
            Route::get('/download_all_case_documents_all/{id}', 'CasesController@download_all_case_documents_all')->name('download_all_case_documents_all');
            Route::post('/edit_case/{id}', 'CasesController@edit_case')->name('edit_case');
            Route::match(['get', 'post'], '/filter_cases', 'CasesController@filter_cases')->name('filter_cases');
            Route::get('/cases_excel', 'CasesController@excel')->name('cases_excel');
            Route::post('/case_add_report', 'CasesController@addCaseReport')->name('case_add_report');
            Route::get('/download_techinical_document/{id}', 'CasesController@downloadTechinicalReportDocument')->name('download_techinical_document');
            Route::get('/download_all_techinical_documents/{id}', 'CasesController@downloadAllTechinicalDocuments')->name('download_all_techinical_documents');
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
            Route::match(['get', 'post'], '/services_filter', 'ServicesController@filter')->name('services_filter');
            Route::match(['get', 'post'], '/services_filter2', 'ServicesController@filter2')->name('services_filter2');
            Route::post('/services_destroy/{id}', 'ServicesController@destroy')->name('services_list_destroy');
            Route::post('/services_destroy_all', 'ServicesController@destroy_all')->name('services_destroy_all');
            Route::get('/report_download_document/{id}', 'ServicesController@download_document')->name('report_download_document');
            Route::get('/report_download_all_documents/{id}', 'ServicesController@download_all_documents')->name('report_download_all_documents');
            Route::get('/services_lawyer/{id}', 'ServicesController@lawyer')->name('services_lawyer');
            Route::get('/services_lawyer_task/{id}', 'ServicesController@lawyer_task')->name('services_lawyer_task');
            Route::post('/services_lawyer_assign/{id}', 'ServicesController@assign')->name('services_lawyer_assign');
            Route::post('/services_lawyer_filter/{id}', 'ServicesController@filter_lawyer')->name('services_lawyer_filter');
            Route::post('/service_add_report', 'ServicesController@addServiceReport')->name('service_add_report');
        });

        Route::middleware(['roles:1,2'])->group(function () {

            Route::get('/tasks_normal', 'TasksController@normal_index')->name('tasks_normal');
            Route::post('/session_destroy/{id}', 'TasksController@destroy')->name('session_destroy');
            Route::post('/session_destroy_all', 'TasksController@destroy_all')->name('session_destroy_all');
            Route::get('/session_excel', 'TasksController@excel')->name('session_excel');
            Route::match(['get', 'post'], '/session_filter', 'TasksController@filter')->name('session_filter');
            Route::get('/substitutions', 'SubstitutionsController@index')->name('substitutions');
            Route::get('/substitutions_edit', 'SubstitutionsController@edit')->name('substitutions.edit');
            Route::get('/substitutions_assign/{id}', 'SubstitutionsController@assign')->name('substitutions.assign');
            Route::post('/substitutions_assign_lawyer/{id}', 'SubstitutionsController@assign_lawyer')->name('substitutions.assign_lawyer');
            Route::post('/substitution_lawyer_assign_filter/{task_id}', 'SubstitutionsController@substitution_lawyer_assign_filter')->name('substitution_lawyer_assign_filter');
            Route::get('/substitutions_delete/{id}', 'SubstitutionsController@delete')->name('substitutions.delete');
            Route::post('/substitutions_delete_all', 'SubstitutionsController@delete_all')->name('substitutions.delete_all');
            Route::post('/substitutions_create', 'SubstitutionsController@create')->name('substitutions.create');
            Route::get('/substitutions_lawyer_task', 'SubstitutionsController@lawyer_task')->name('substitutions.lawyer_task');
            Route::get('/substitutions_view/{id}', 'SubstitutionsController@show')->name('substitutions.view');
            Route::get('/substitutions/excel', 'SubstitutionsController@excel')->name('substitutions.excel');
            Route::get('real-state-registration-request', 'RealStateRequestController@index')->name('real-state-registration-request');
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
            Route::match(['get', 'post'], '/emergency_task_filter', 'EmergencyTasksController@emergency_task_filter')->name('emergency_task_filter');
            Route::post('/add_emergency_task_document', 'EmergencyTasksController@addEmergencyTaskDocument')->name('add_emergency_task_document');
        });



        Route::middleware(['roles:1'])->group(function () {

            Route::get('/reports_statistics', 'ReportsStatisticsController@index')->name('reports_statistics');
            Route::post('/reports_statistics/filter', 'ReportsStatisticsController@filter')->name('report.filter');
            Route::get('/reports_cases_export', 'ReportsStatisticsController@cases_exportXLS')->name('reports_cases_export');

            Route::get('/reports_installments_export', 'ReportsStatisticsController@installments_exportXLS')->name('reports_installments_export');
            Route::get('/reports_urgents_export', 'ReportsStatisticsController@urgents_exportXLS')->name('reports_urgents_export');
            Route::get('/reports_tasks_export', 'ReportsStatisticsController@tasks_exportXLS')->name('reports_tasks_export');
            Route::get('/reports_casetype_export', 'ReportsStatisticsController@casetype_exportXLS')->name('reports_casetype_export');
        });


        Route::middleware(['roles:1,2,3,4'])->group(function () {
            Route::get('/records', 'RecordsController@index')->name('records');
            Route::get('/records/create', 'RecordsController@create')->name('records.add');
            Route::post('/records/store', 'RecordsController@store')->name('record.store');
            Route::get('/records/destroySelected', 'RecordsController@destroySelected')->name('records.destroySelected');
            Route::get('/records/destroy/{id}', 'RecordsController@destroy')->name('records.deleteRecord');
            Route::post('/records/filter', 'RecordsController@filter')->name('records.filter');
            Route::get('/records/export/excell', 'RecordsController@exportXLS')->name('records.exportXLS');
        });


        Route::get('/home', 'HomeController@index')->name('home');
    });


    Route::get('/Landing/{lang}', 'LandingController@index')->name('landing');
    Route::post('/Landing/ind', 'LandingController@ind')->name('landing.ind');
    Route::post('/Landing/lawyer', 'LandingController@lawyer')->name('landing.lawyer');
    Route::post('/Landing/office', 'LandingController@office')->name('landing.office');

    //payments
    Route::get('/payment', 'paymentController@index')->name('payment_index');
    Route::get('/payment/destroySelected', 'paymentController@destroySelected')->name('pay.destroySelected');
    Route::get('/payment/destroy/{id}', 'paymentController@destroy')->name('pay.deleteRecord');
    Route::post('/payment/filter', 'paymentController@filter')->name('pay.filter');




    //offices
    Route::middleware(['roles:1,2'])->group(function () {
        Route::get('/offices', 'OfficesController@index')->name('offices');
        //Route::get('/offices_follow', 'OfficesController@follow')->name('offices_follow');
        Route::get('/offices_show/{id}', 'OfficesController@show')->name('offices_show');
        Route::get('/offices_create', 'OfficesController@create')->name('offices_create');
        Route::post('/offices_store', 'OfficesController@store')->name('offices_store');
        Route::get('/offices_edit/{id}', 'OfficesController@edit')->name('offices_edit');
        Route::post('/offices_update/{id}', 'OfficesController@update')->name('offices_update');

        Route::post('/offices_destroy_post/{id}', 'OfficesController@destroyPost')->name('offices_destroy_post');
        Route::post('/offices_city_filter', 'OfficesController@cityFilter')->name('offices_city_filter');

        //offices Branches
        Route::post('/branches_store', 'OfficesController@branch_create')->name('branches_store');
        Route::post('/branches_edit', 'OfficesController@branch_edit')->name('branches_edit');
        Route::post('/branches_delete/{id}', 'OfficesController@branch_destroy')->name('branches_delete');
        Route::get('/get_cities/{country_id}', 'OfficesController@get_cities')->name('get_cities');
    });

    //Contact us
    Route::middleware(['roles:1,2'])->group(function () {
        Route::match(array('GET', 'POST'), '/contact_us', 'CompanyContactInfoController@index')->name('contact_us');
        Route::post('/contact_us/addsocialaccount', 'CompanyContactInfoController@addSocialAccount')->name('add_social_account');
        Route::post('/contact_us/deletesocialaccount', 'CompanyContactInfoController@deleteSocialAccount')->name('delete_social_account');
        Route::post('/contact_us/Localization', 'CompanyContactInfoController@getLocalization')->name('get_localization');
    });

    Route::middleware(['roles:1,2'])->group(function () {

        Route::get('/contactus/index', 'ContactUsController@index')->name('contactus_index');
        Route::get('/contactus/add', 'ContactUsController@add')->name('contactus_add');
        Route::get('/contactus/edit/{id}', 'ContactUsController@edit')->name('contactus_edit');
        Route::get('/contactus/delete/{id}', 'ContactUsController@delete')->name('contactus_delete');
        Route::post('/contactus/create', 'ContactUsController@create')->name('contactus_create');
        Route::post('/contactus/update/{id}', 'ContactUsController@update')->name('contactus_update');
        Route::post('/contactus/delete_all', 'ContactUsController@destroy_all')->name('contactus_delete_all');
        Route::post('/contactus/Localization', 'ContactUsController@getLocalization')->name('get_localization_contact');
        Route::post('/contactus/Localization/add', 'ContactUsController@addLocalization')->name('add_localization_contact');
    });
});
Route::get('/notifications_cron', 'NotificationsController@notification_cron')->name('notifications.cron');
Route::get('/push_notification', 'NotificationsController@push_notification')->name('push.notification');