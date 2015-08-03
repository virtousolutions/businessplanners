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
Route::post("contactus", array('uses' => 'HomeController@contactus'));

Route::post("book_now", ['uses' => 'HomeController@bookNow', 'as' => 'booknow']);

Route::post("contact_us", array(
	'as' => 'contact_us',
	'uses' => "HomeController@sendContactUs"
));

Route::get('book-successfull', 'HomeController@book_success');

Route::get('thank-you/{product}', 'HomeController@thankyoupage');

Route::group(['before' => 'guest'], function()
{
    Route::get("login", "AuthController@login");
    Route::post("login", "AuthController@loginSubmit");
    Route::get("order/{package}", "HomeController@order");
    Route::post("order/{package}", "HomeController@orderSubmit");
    Route::get("order-complete/{package}", "HomeController@orderComplete");

    Route::get('password/reset', array(
      'uses' => 'PasswordController@remind',
      'as' => 'password.remind'
    ));

    Route::post('password/reset', array(
      'uses' => 'PasswordController@request',
      'as' => 'password.request'
    ));

    Route::get('password/reset/{token}', array(
      'uses' => 'PasswordController@reset',
      'as' => 'password.reset'
    ));
    Route::post('password/reset/{token}', array(
      'uses' => 'PasswordController@update',
      'as' => 'password.update'
    ));
    
    Route::get('start_payment', 'PaypalPaymentController@startPayment');
    Route::get('cancel_payment/{timestamp}', 'PaypalPaymentController@cancelPayment');
    Route::get('complete_payment/{timestamp}', 'PaypalPaymentController@completePayment');
});

Route::get("terms", 'HomeController@terms');
Route::get("privacy-policy", 'HomeController@privacy');
Route::get("cookie-policy", 'HomeController@license');
Route::get("survey/{user_id}", 'HomeController@survey');
Route::get("survey", 'HomeController@survey');
Route::post("survey/{user_id}", 'HomeController@surveySubmit');
Route::post("survey", 'HomeController@surveySubmit');
Route::get("email/view/{enc_user_id}/{enc_temp_password}", 'HomeController@emailView');

Route::get("value-business-plan-package", "PackageController@diy");
Route::get("standard-business-plan-package", "PackageController@value");
Route::get("professional-business-plan-package", "PackageController@standard");
Route::get("premium-business-plan-package", "PackageController@professional");
Route::get("entrepreneur-business-plan-package", "PackageController@premium");

Route::group(['before' => 'auth'], function()
{
    Route::get("change-temp-password", 'AuthController@changeTempPassword');
    Route::post("change-temp-password", 'AuthController@changeTempPasswordSubmit');

    Route::get("logout", "AuthController@logout");
});

Route::group(['before' => 'auth|not_expired|not_temp_password'], function()
{
    Route::get("plan", 'PlanController@index');

    Route::get("create", 'PlanController@create');
    Route::post("create", 'PlanController@createSubmit');

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
    Route::post("plan/financial-plan-budget-dividend", 'PlanController@saveFinancialPlanBudgetDividend');
    Route::get("plan/financial-plan-budget-delete-expenditure/{id}", 'PlanController@saveFinancialPlanBudgetDeleteExpenditure');
    Route::get("plan/financial-plan-budget-delete-purchase/{id}", 'PlanController@saveFinancialPlanBudgetDeletePurchase');
    Route::get("plan/financial-plan-budget-delete-dividend/{id}", 'PlanController@saveFinancialPlanBudgetDeleteDividend');

    Route::get("plan/financial-plan-human-resources/{id}", 'PlanController@editFinancialPlanHumanResources');
    Route::post("plan/financial-plan-human-resources-personnel", 'PlanController@saveFinancialPlanHumanResourcesPersonnel');
    Route::post("plan/financial-plan-human-resources-expenses", 'PlanController@saveFinancialPlanHumanResourcesExpenses');
    Route::get("plan/financial-plan-human-resources-delete-personnel/{id}", 'PlanController@saveFinancialPlanHumanResourcesDeletePersonnel');

    Route::get("plan/financial-plan-sales-forecast/{id}", 'PlanController@editFinancialPlanSalesForecast');
    Route::post("plan/financial-plan-sales-forecast", 'PlanController@saveFinancialPlanSalesForecast');
    Route::get("plan/financial-plan-sales-forecast-delete/{id}", 'PlanController@deleteFinancialPlanSalesForecast');

    Route::get("plan/financial-plan-loans-and-investments/{id}", 'PlanController@editFinancialPlanLoans');
    Route::post("plan/financial-plan-loans-and-investments", 'PlanController@saveFinancialPlanLoans');
    Route::get("plan/financial-plan-loans-and-investments-delete/{id}", 'PlanController@deleteFinancialPlanLoans');

    Route::post("plan/details/{id}", 'PlanController@submitDetails');
    Route::post("plan/save_page", 'PlanController@savePage');
    Route::post("plan/save_section", 'PlanController@saveSection');

    Route::get("plan/print/{id}", 'PlanController@printDoc');

    Route::get("profile", 'PlanController@profile');
    Route::post("profile", 'PlanController@profileSubmit');

});

Route::group(['before' => 'auth|not_temp_password'], function()
{
    Route::get("account-expired", 'PlanController@expired');
});
// Route::get('payment', function($alias) {
//   return Redirect::to('p' . $alias);
// });


//Resources
Route::get("resources", 'HomeController@resources');
Route::get("resources/download", 'HomeController@resourcesDownload');
Route::post("resources/download", 'HomeController@resourcesDownload');