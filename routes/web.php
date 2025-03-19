<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('/', function () {
    return view('main.home');
});

Auth::routes();
Route::get('/generate_roi', [App\Http\Controllers\Cron::class, 'calculateRoi_income'])->name('generate_roi');

// Route::get('/generate_roi', [App\Http\Controllers\Cron::class, 'generate_roi_bonus'])->name('generate_roi');
Route::get('/rank-update', [App\Http\Controllers\Cron::class, 'rank_update'])->name('rank-update');
Route::get('/reward_bonus', [App\Http\Controllers\Cron::class, 'reward_bonus'])->name('reward_bonus');
Route::get('/royalty_bonus', [App\Http\Controllers\Cron::class, 'dailyIncentive'])->name('royalty_bonus');
Route::get('/managePayout22', [App\Http\Controllers\Cron::class, 'managePayout22'])->name('managePayout22');
Route::get('/managePayout', [App\Http\Controllers\Cron::class, 'managePayout'])->name('managePayout');
Route::get('/achieve_rank_bonus', [App\Http\Controllers\Cron::class, 'achieve_rank_bonus'])->name('achieve_rank_bonus');
Route::get('/RoyalExel', [App\Http\Controllers\Cron::class, 'RoyalExel'])->name('RoyalExel');


Route::post('login', [App\Http\Controllers\Login::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Login::class, 'logout'])->name('logout');
Route::get('forgot-password', [App\Http\Controllers\Login::class, 'forgot_password'])->name('forgot-password');
Route::any('forgot_submit', [App\Http\Controllers\Login::class, 'forgot_password_submit'])->name('forgot_submit');
Route::any('submitResetPassword', [App\Http\Controllers\Login::class, 'submitResetPassword'])->name('submitResetPassword');
Route::any('verifyCode', [App\Http\Controllers\Login::class, 'verifyCode'])->name('verifyCode');
Route::get('codeVerify', [App\Http\Controllers\Login::class, 'codeVerify'])->name('codeVerify');
Route::get('resetPassword', [App\Http\Controllers\Login::class, 'resetPassword'])->name('resetPassword');

Route::post('/getUserName', [App\Http\Controllers\Register::class, 'getUserNameAjax'])->name('getUserName');
Route::post('/registers', [App\Http\Controllers\Register::class, 'register'])->name('registers');
Route::get('/register_sucess', [App\Http\Controllers\Register::class, 'index'])->name('register_sucess');

Route::get('/Index', [App\Http\Controllers\FrontController::class, 'index'])->name('Index');
Route::get('/about-us', [App\Http\Controllers\FrontController::class, 'about'])->name('about-us');
Route::get('/services', [App\Http\Controllers\FrontController::class, 'services'])->name('services');
Route::get('/blog-details', [App\Http\Controllers\FrontController::class, 'Blog'])->name('blog-details');
Route::get('/contact-us', [App\Http\Controllers\FrontController::class, 'contact'])->name('contact-us');
Route::get('/add-properties', [App\Http\Controllers\FrontController::class, 'addProperties'])->name('add-properties');
Route::get('/properties-detail', [App\Http\Controllers\FrontController::class, 'detailProperties'])->name('properties-detail');

Route::get('/faq', [App\Http\Controllers\FrontController::class, 'faq'])->name('faq');
Route::get('/start', [App\Http\Controllers\FrontController::class, 'aitrading'])->name('start');
Route::get('/affiliate', [App\Http\Controllers\FrontController::class, 'affiliate'])->name('affiliate');
Route::get('/term-candition', [App\Http\Controllers\FrontController::class, 'termcandition'])->name('term-candition');
Route::get('/news', [App\Http\Controllers\FrontController::class, 'news'])->name('news');
Route::get('/partners', [App\Http\Controllers\FrontController::class, 'partners'])->name('partners');


Route::get('/home', [App\Http\Controllers\UserPanel\Dashboard::class, 'index'])->name('home');
Route::prefix('user')->group(function ()
{
Route::middleware('auth')->group(function ()
{
Route::get('/dashboard', [App\Http\Controllers\UserPanel\Dashboard::class, 'index'])->name('user.dashboard');
Route::post('/sendCode', [App\Http\Controllers\UserPanel\Dashboard::class, 'sendCode'])->name('user.send_code');

Route::get('/tradeOn', [App\Http\Controllers\UserPanel\Dashboard::class, 'tradeOn'])->name('user.tradeOn');

Route::get('/forgotPassword', [App\Http\Controllers\UserPanel\Dashboard::class, 'forgotPassword'])->name('user.forgotPassword');
Route::get('/market', [App\Http\Controllers\UserPanel\Dashboard::class, 'market'])->name('user.market');
Route::get('/news', [App\Http\Controllers\UserPanel\Dashboard::class, 'news'])->name('user.news');
Route::get('/activities', [App\Http\Controllers\UserPanel\Dashboard::class, 'activities'])->name('user.activities');
Route::post('/submitActivity', [App\Http\Controllers\UserPanel\Dashboard::class, 'submitActivity'])->name('user.submitActivity');

// profile
Route::post('/bank-details', [App\Http\Controllers\UserPanel\Profile::class, 'bank_details'])->name('user.bank_details');

Route::get('/profile', [App\Http\Controllers\UserPanel\Profile::class, 'index'])->name('user.profile');
Route::post('/update-profile', [App\Http\Controllers\UserPanel\Profile::class, 'profile_update'])->name('user.update-profile');
Route::get('/ChangePass', [App\Http\Controllers\UserPanel\Profile::class, 'change_password'])->name('user.ChangePass');
Route::get('/security-password', [App\Http\Controllers\UserPanel\Profile::class, 'ChangeSecurityPass'])->name('user.security-password');
Route::get('/share', [App\Http\Controllers\UserPanel\Profile::class, 'share'])->name('user.share');

Route::post('/send-verification-code', [App\Http\Controllers\UserPanel\Profile::class, 'sendVerificationCode'])->name('user.send-verification-code');

Route::post('/edit-password', [App\Http\Controllers\UserPanel\Profile::class, 'change_password_post'])->name('user.edit-password');
Route::get('/BankDetail', [App\Http\Controllers\UserPanel\Profile::class, 'BankDetail'])->name('user.BankDetail');
Route::post('/bank-update', [App\Http\Controllers\UserPanel\Profile::class, 'bank_profile_update'])->name('user.bank-update');
Route::post('/change-trxpasswword', [App\Http\Controllers\UserPanel\Profile::class, 'change_trxpassword_post'])->name('user.change-trxpasswword');
// end profile

// wallet 
Route::get('/wallets', [App\Http\Controllers\UserPanel\Profile::class, 'wallets'])->name('user.wallets');


// add fund
  Route::get('/transfer-fund', [App\Http\Controllers\UserPanel\AddFund::class, 'transfer_fund'])->name('user.transfer-fund');
 Route::post('/fundtransferSubmit', [App\Http\Controllers\UserPanel\AddFund::class, 'SubmitTransferFund'])->name('user.fundtransferSubmit');

Route::get('/AddFund', [App\Http\Controllers\UserPanel\AddFund::class, 'index'])->name('user.AddFund');
Route::get('/fundHistory', [App\Http\Controllers\UserPanel\AddFund::class, 'fundHistory'])->name('user.fundHistory');
Route::any('/SubmitBuyFund', [App\Http\Controllers\UserPanel\AddFund::class, 'SubmitBuyFund'])->name('user.SubmitBuyFund');
// end add fund

// invest
Route::get('/invest', [App\Http\Controllers\UserPanel\Invest::class, 'index'])->name('user.invest');
Route::get('/autoinvest', [App\Http\Controllers\UserPanel\Invest::class, 'autoinvest'])->name('user.autoinvest');
Route::post('/fundActivation', [App\Http\Controllers\UserPanel\Invest::class, 'fundActivation'])->name('user.fundActivation');
Route::post('/fundActivation2', [App\Http\Controllers\UserPanel\Invest::class, 'fundActivation2'])->name('user.fundActivation2');
Route::any('/confirmDeposit', [App\Http\Controllers\UserPanel\Invest::class, 'confirmDeposit'])->name('user.confirmDeposit');

Route::get('/DepositHistory', [App\Http\Controllers\UserPanel\Invest::class, 'invest_list'])->name('user.DepositHistory');
Route::get('/deposit-status', [App\Http\Controllers\UserPanel\Invest::class, 'depositStatus'])->name('user.Depositstatus');
Route::get('/withdraw-status', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'withdrawStatus'])->name('user.withdrawalstatus');
// end invest

// withdraw

Route::get('/withdraw-info', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'withdrawInfo'])->name('user.withdrawinfo');
Route::get('/debitReport', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'debitReport'])->name('user.debitReport');
Route::get('/Withdraw', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'index'])->name('user.Withdraw');
Route::get('/withdrawPrinciple', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'withdrawPrinciple'])->name('user.withdrawPrinciple');

Route::post('/WithdrawRequest', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'WithdrawRequest'])->name('user.Withdraw-Request');
Route::post('/WithdrawRequestPrinciple', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'WithdrawRequestPrinciple'])->name('user.WithdrawRequestPrinciple');
Route::get('/WithdrawHistory', [App\Http\Controllers\UserPanel\WithdrawRequest::class, 'WithdrawHistory'])->name('user.Withdraw-History');
// end withdraw

//team
Route::get('/user-refer', [App\Http\Controllers\UserPanel\Team::class, 'refer'])->name('user.refer');
Route::get('/referral-team', [App\Http\Controllers\UserPanel\Team::class, 'index'])->name('user.referral-team');
Route::get('/level-team', [App\Http\Controllers\UserPanel\Team::class, 'LevelTeam'])->name('user.level-team');
Route::get('/left-team', [App\Http\Controllers\UserPanel\Team::class, 'leftteam'])->name('user.left-team');
Route::get('/right-team', [App\Http\Controllers\UserPanel\Team::class, 'rightteam'])->name('user.right-team');
Route::get('/tree-view', [App\Http\Controllers\UserPanel\Team::class, 'genealogy'])->name('user.tree-view');
Route::any('/UsrBinaryReport',[App\Http\Controllers\UserPanel\BinaryReport::class,'userReport'])->name('UsrBinaryReport');
//end team

//bonus
Route::get('/level-income', [App\Http\Controllers\UserPanel\Bonus::class, 'index'])->name('user.level-income');
Route::get('/direct-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'direct_bonus'])->name('user.direct-bonus');
Route::get('/matching-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'cashback_income'])->name('user.matching-bonus');
Route::get('/reward-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'reward_income'])->name('user.reward-bonus');
Route::get('/roi-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'roi_income'])->name('user.roi-bonus');
Route::get('/dailyIncentive', [App\Http\Controllers\UserPanel\Bonus::class, 'dailyIncentive'])->name('user.dailyIncentive');
Route::get('/activitiesBonus', [App\Http\Controllers\UserPanel\Bonus::class, 'activitiesBonus'])->name('user.activitiesBonus');

Route::get('/gap-margin-bonus', [App\Http\Controllers\UserPanel\Bonus::class, 'gap_margin_bonus'])->name('user.gap-margin-bonus');
//end bonus

//tickets
Route::get('/ticket',[App\Http\Controllers\UserPanel\Tickets::class,'ticket'])->name('user.ticket');
Route::get('/ticket-status',[App\Http\Controllers\UserPanel\Tickets::class,'ticketStatus'])->name('user.ticket-status');
Route::get('/GenerateTicket',[App\Http\Controllers\UserPanel\Tickets::class,'GenerateTicket'])->name('user.GenerateTicket');
Route::post('/SubmitTicket',[App\Http\Controllers\UserPanel\Tickets::class,'SubmitTicket'])->name('user.SubmitTicket');
Route::get('/SupportMessage',[App\Http\Controllers\UserPanel\Tickets::class,'SupportMessage'])->name('user.SupportMessage');
Route::get('/ViewMessage',[App\Http\Controllers\UserPanel\Tickets::class,'ViewMessage'])->name('user.ViewMessage');

//end tickets

});
});


// admin

Route::prefix('admin')->group(function () {
Route::get('/admin-login', [App\Http\Controllers\Admin\AdminLogin::class, 'index'])->name('admin.admin-login');
Route::post('LoginAction', [App\Http\Controllers\Admin\AdminLogin::class, 'admin_login'])->name('admin.LoginAction');
Route::get('/admin-logout', [App\Http\Controllers\Admin\AdminLogin::class, 'admin_sign_out'])->name('admin.admin-logout');
Route::group(['middleware' => ['admin']], function ()
{

 Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('admin.dashboard');
 Route::post('/sendCode', [App\Http\Controllers\Admin\Dashboard::class, 'sendCode'])->name('admin.send_code');

 Route::get('/loginWithadmin', [App\Http\Controllers\Admin\Dashboard::class, 'loginWithadmin'])->name('admin.loginWithadmin');
 Route::get('/changePassword', [App\Http\Controllers\Admin\Dashboard::class, 'changePassword'])->name('admin.changePassword');
 Route::get('/add-price', [App\Http\Controllers\Admin\Dashboard::class, 'addPrice'])->name('admin.add-price');
 Route::get('/addreward', [App\Http\Controllers\Admin\Dashboard::class, 'addreward'])->name('admin.addreward');
 Route::get('/addActivityBonus', [App\Http\Controllers\Admin\Dashboard::class, 'addActivityBonus'])->name('admin.addActivityBonus');
 Route::post('/change-price', [App\Http\Controllers\Admin\Dashboard::class, 'change_price'])->name('admin.change-price');
 Route::get('/add-address', [App\Http\Controllers\Admin\Dashboard::class, 'add_address'])->name('admin.add-address');
 Route::get('/debit', [App\Http\Controllers\Admin\Dashboard::class, 'debit'])->name('admin.debit');
 Route::post('/add_wallet', [App\Http\Controllers\Admin\Dashboard::class, 'add_wallet'])->name('admin.add_wallet');

 
 Route::post('/add_reward', [App\Http\Controllers\Admin\Dashboard::class, 'add_reward'])->name('admin.add_reward');
 Route::post('/add_activities_reward', [App\Http\Controllers\Admin\Dashboard::class, 'add_activities_reward'])->name('admin.add_activities_reward');
 Route::post('/add_debit', [App\Http\Controllers\Admin\Dashboard::class, 'add_debit'])->name('admin.add_debit');
 
 Route::post('/change-password-post', [App\Http\Controllers\Admin\Dashboard::class, 'change_password_post'])->name('admin.change-password-post');

 // active users controller


//  Route::get('/active-user', [App\Http\Controllers\Admin\ActiveuserController::class, 'active_user'])->name('admin.active-user');
//  Route::post('activate-admin', [App\Http\Controllers\Admin\ActiveuserController::class, 'activate_admin_post'])->name('admin.activate-admin');
 Route::get('user-activation', [App\Http\Controllers\Admin\UserController::class, 'user_activation'])->name('admin.user-activation');
 Route::any('activate_admin_post', [App\Http\Controllers\Admin\UserController::class, 'activate_admin_post'])->name('admin.activate_admin_post');

 // usercontroller

 Route::get('/userSummary', [App\Http\Controllers\Admin\UserController::class, 'userSummary'])->name('admin.userSummary');
 Route::get('/totalusers', [App\Http\Controllers\Admin\UserController::class, 'alluserlist'])->name('admin.totalusers');
 Route::get('/active-users', [App\Http\Controllers\Admin\UserController::class, 'active_users'])->name('admin.active-users');
 Route::get('/pending-user', [App\Http\Controllers\Admin\UserController::class, 'pending_users'])->name('admin.pending-user');
 Route::get('/edit-users', [App\Http\Controllers\Admin\UserController::class, 'edit_users'])->name('admin.edit-users');
 Route::get('edit-user-view/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit_users_view'])->name('admin.edit-user-view');
 Route::get('profile-view/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile_view'])->name('admin.profile-view');

 Route::any('update-user-profile', [App\Http\Controllers\Admin\UserController::class, 'users_profile_update'])->name('admin.update-user-profile');
 Route::get('/block-users', [App\Http\Controllers\Admin\UserController::class, 'block_users'])->name('admin.block-users');
 Route::get('block-submit', [App\Http\Controllers\Admin\UserController::class, 'block_submit'])->name('admin.block-submit');
 Route::get('deposit-activities', [App\Http\Controllers\Admin\UserController::class, 'pendingActivities'])->name('admin.deposit-activities');
 Route::get('activities-list', [App\Http\Controllers\Admin\UserController::class, 'activities_list'])->name('admin.activities-list');
 Route::get('activities_submit', [App\Http\Controllers\Admin\UserController::class, 'activities_submit'])->name('admin.activities_submit');
 
 //end userController

//DepositManagmentController
 Route::get('/depodit-request', [App\Http\Controllers\Admin\DepositController::class, 'deposit_request'])->name('admin.deposit-request');
 Route::get('/rejected-deposit', [App\Http\Controllers\Admin\DepositController::class, 'rejected_deposit'])->name('admin.rejected-deposit');

 Route::get('/depodit-list', [App\Http\Controllers\Admin\DepositController::class, 'deposit_list'])->name('admin.deposit-list');
 Route::get('deposit_request_done', [App\Http\Controllers\Admin\DepositController::class, 'deposit_request_done'])->name('admin.deposit_request_done');
// end DepositManagmentController



//bonusController
Route::get('roi-bonus', [App\Http\Controllers\Admin\BonusController::class, 'roi_bonus'])->name('admin.roi-bonus');
Route::get('level-bonus', [App\Http\Controllers\Admin\BonusController::class, 'level_bonus'])->name('admin.level-bonus');
Route::get('booster-bonus', [App\Http\Controllers\Admin\BonusController::class, 'booster_bonus'])->name('admin.booster-bonus');
Route::get('club-bonus', [App\Http\Controllers\Admin\BonusController::class, 'club_bonus'])->name('admin.club-bonus');
Route::get('reward-bonus', [App\Http\Controllers\Admin\BonusController::class, 'reward_bonus'])->name('admin.reward-bonus');
Route::get('activities-bonus', [App\Http\Controllers\Admin\BonusController::class, 'activities_bonus'])->name('admin.activities-bonus');


// withdraw
Route::get('pendingWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'pendingWithdrawal'])->name('admin.pendingWithdrawal');
Route::get('withdraw_request_done', [App\Http\Controllers\Admin\WithdrawController::class, 'withdraw_request_done'])->name('admin.withdraw_request_done');
Route::get('rejectedWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'rejectedWithdrawal'])->name('admin.rejectedWithdrawal');
Route::get('approvedWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'approvedWithdrawal'])->name('admin.approvedWithdrawal');
Route::get('pendingBankWithdrawal', [App\Http\Controllers\Admin\WithdrawController::class, 'pendingBankWithdrawal'])->name('admin.pendingBankWithdrawal');

// support


Route::get('support-query', [App\Http\Controllers\Admin\SupportController::class, 'index'])->name('admin.support-query');
Route::get('get_support_msg', [App\Http\Controllers\Admin\SupportController::class, 'get_support_msg'])->name('admin.get_support_msg');
Route::get('close_ticket_', [App\Http\Controllers\Admin\SupportController::class, 'close_ticket_'])->name('admin.close_ticket_');
Route::get('reply_support_msg', [App\Http\Controllers\Admin\SupportController::class, 'reply_support_msg'])->name('admin.reply_support_msg');
Route::post('admin_ticket_submit', [App\Http\Controllers\Admin\SupportController::class, 'admin_ticket_submit'])->name('admin.admin_ticket_submit');

});

});
