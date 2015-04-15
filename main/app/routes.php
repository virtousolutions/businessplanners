<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get("/", "HomeController@index");

Route::post("contact_us", array(
	'as' => 'contact_us',
	'uses' => "HomeController@sendContactUs"
));

Route::get("terms", 'HomeController@terms');
Route::get("privacy", 'HomeController@privacy');
Route::get("license", 'HomeController@license');
Route::get("order/{number}", "HomeController@order");
Route::post("order/{number}", "HomeController@orderSubmit");
Route::get('paymentcomplete', 'HomeController@paymentComplete');

Route::get('start_payment', 'PaypalPaymentController@startPayment');
Route::get('cancel_payment/{timestamp}', 'PaypalPaymentController@cancelPayment');
Route::get('complete_payment/{timestamp}', 'PaypalPaymentController@completePayment');

Route::get("plan", 'PlanController@create');
Route::post("plan", 'PlanController@createSubmit');

Route::get("plan/executive-summary/{section}/{id}", 'PlanController@executiveSummary');
Route::get("plan/company/{section}/{id}", 'PlanController@company');
Route::get("plan/products-and-services/{section}/{id}", 'PlanController@products');
Route::get("plan/target-market/{section}/{id}", 'PlanController@targetMarket');
Route::get("plan/strategy-and-implementation/{section}/{id}", 'PlanController@strategy');
Route::get("plan/financial-plan/{section}/{id}", 'PlanController@financialPlan');
Route::get("plan/financial-statements/{section}/{id}", 'PlanController@financialStatements');
Route::get("plan/details/{id}", 'PlanController@details');
Route::get("plan/refresh-page", 'PlanController@refreshPage');

Route::get("plan/financial-plan-cash-flow-projections/{id}", 'PlanController@editFinancialPlanCashFlow');
Route::post("plan/financial-plan-cash-flow-projections", 'PlanController@saveFinancialPlanCashFlow');

Route::get("plan/financial-plan-budget/{id}", 'PlanController@editFinancialPlanBudget');
Route::post("plan/financial-plan-budget-expenditure", 'PlanController@saveFinancialPlanBudgetExpenditure');
Route::post("plan/financial-plan-budget-purchase", 'PlanController@saveFinancialPlanBudgetPurchase');
Route::post("plan/financial-plan-budget-tax", 'PlanController@saveFinancialPlanBudgetTax');
Route::get("plan/financial-plan-budget-delete-expenditure/{id}", 'PlanController@saveFinancialPlanBudgetDeleteExpenditure');
Route::get("plan/financial-plan-budget-delete-purchase/{id}", 'PlanController@saveFinancialPlanBudgetDeletePurchase');


Route::get("plan/financial-plan-human-resources/{id}", 'PlanController@editFinancialPlanHumanResources');
Route::post("plan/financial-plan-human-resources-personnel", 'PlanController@saveFinancialPlanHumanResourcesPersonnel');
Route::post("plan/financial-plan-human-resources-expenses", 'PlanController@saveFinancialPlanHumanResourcesExpenses');
Route::get("plan/financial-plan-human-resources-delete-personnel/{id}", 'PlanController@saveFinancialPlanHumanResourcesDeletePersonnel');

Route::get("plan/financial-plan-sales-forecast/{id}", 'PlanController@editFinancialPlanSalesForecast');
Route::post("plan/financial-plan-sales-forecast", 'PlanController@saveFinancialPlanSalesForecast');
Route::get("plan/financial-plan-sales-forecast-delete/{id}", 'PlanController@deleteFinancialPlanSalesForecast');

Route::post("plan/details/{id}", 'PlanController@submitDetails');
Route::post("plan/save_page", 'PlanController@savePage');
Route::post("plan/save_section", 'PlanController@saveSection');