<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ShopDetailController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationConfirmationController;
use App\Http\Controllers\CommentsIndexController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CreateShopManagerController;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\EditShopManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VisitedShopController;
use App\Http\Controllers\QrCodeController;
use App\Http\Livewire\ReservationForm;


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

//新規会員登録画面表示
Route::view('/register', 'auth.register')
    ->name('register');

//ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);


//新規ユーザー登録
Route::post('/register', [RegisteredUserController::class, 'store']);

// メール再送信ルートを追加
Route::post('/email/verification/send', [RegisteredUserController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

//ホーム画面表示
Route::get('/', [ShopController::class, 'indexPublic'])
    ->name('shop.all');

//ホーム画面表示
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ShopController::class, 'index'])
        ->name('shop.all.private');
});

//検索機能
Route::post('/search', [ShopController::class, 'search'])
    ->name('shop.search');

//検索機能
Route::get('/search', [ShopController::class, 'searchBySession'])
    ->name('shop.search.get');

//お気に入りボタン
Route::post('/favorite', [FavoriteController::class, 'toggle'])
    ->name('favorite.toggle');

//詳細ページ表示
Route::get('/detail/{shop_id}', [ShopDetailController::class, 'show'])
    ->name('shop.detail');

//サンクスページ表示
Route::get('/thanks', [ShopDetailController::class, 'thanks'])
    ->name('thanks');

//予約機能
Route::post('/reserve', [ReservationForm::class, 'reserve'])
    ->name('shop.reserve');

//お気に入り店舗マイページ表示
Route::get('/mypage', [MypageController::class, 'show'])
    ->name('mypage');

//予約内容変更機能
Route::post('/update-reservation', [MyPageController::class, 'updateReservation'])
    ->name('update.reservation');

//予約キャンセル機能
Route::post('/cancel', [MyPageController::class, 'cancelReservation'])
    ->name('cancel.reservation');

//予約状況確認画面表示
Route::get('/reservation', [ReservationConfirmationController::class, 'index'])
    ->name('reservation.confirmation');

// 口コミ表示
Route::get('/shop/{shop}/comments', [CommentsIndexController::class, 'index'])
    ->name('comments.index');

//口コミ投稿画面表示
Route::get('/rateing/{shop_id}', [RatingController::class, 'index'])
    ->name('rating.index');

//口コミ投稿機能
Route::post('/rateing', [RatingController::class, 'store'])
    ->name('rating.store');

//新規店舗作成画面表示
Route::get('/create', [CreateShopManagerController::class, 'index'])
    ->middleware('auth')
    ->name('create.shop.manager');

//新規店舗作成機能
Route::post('/create', [CreateShopManagerController::class, 'store'])
    ->name('store.shop.manager');

// 店舗情報更新画面表示
Route::get('/shoplist', [ShoplistController::class, 'index'])
    ->middleware('auth')
    ->name('shop.list');

// 店舗情報更新画面表示
Route::get('/edit', [EditShopManagerController::class, 'index'])
    ->middleware('auth')
    ->name('edit.shop.manager');

//店舗情報更新機能
Route::post('/update', [EditShopManagerController::class, 'update'])
    ->name('shop.update');

//サイト管理者画面表示
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

//店舗代表者作成機能
Route::post('/admin/create-representative', [AdminController::class, 'createRepresentative'])
    ->name('admin.createRepresentative');

//リマインドメール送信機能
Route::get('/send-mail', [MailController::class, 'showMail'])
    ->middleware('auth')
    ->name('send.mail');

//リマインドメール送信機能
Route::post('/send-mail', [MailController::class, 'sendMail']);

//訪店店舗一覧画面表示
Route::get('/visited-shop', [VisitedShopController::class, 'index'])
    ->name('visited.shop');

//QRコード作成機能
Route::get('/qrcode/{id}', [QrCodeController::class, 'generate']);

//決済画面表示
Route::get('/payment/{reservation_id}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

//決済機能
Route::post('/process-payment', [PaymentController::class, 'processPayment'])
    ->name('payment.process');
