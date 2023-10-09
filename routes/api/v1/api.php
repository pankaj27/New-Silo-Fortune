<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['namespace' => 'api\v1', 'prefix' => 'v1', 'middleware' => ['api_lang']], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
        Route::post('register', 'PassportAuthController@register');
        Route::post('login', 'PassportAuthController@login');
        
        Route::post('login-with-mobile-number', 'PassportAuthController@loginWithMobileNumber');//New_addition_07_10_2023
        Route::post('check-phone-mobile-otp', 'PhoneVerificationController@check_phone_mobile_otp');//New_addition_07_10_2023
        
        Route::post('verify-otp-for-sign-in-and-sign-up', 'PassportAuthController@otp_verification_submit_for_sign_in_sign_up');
        
        Route::post('verify-phone-for-signin-and-signup', 'PassportAuthController@verify_phone_for_signin_and_signup'); 
        
        

        Route::post('check-phone', 'PhoneVerificationController@check_phone');
        Route::post('verify-phone', 'PhoneVerificationController@verify_phone');

        Route::post('check-email', 'EmailVerificationController@check_email');
        Route::post('verify-email', 'EmailVerificationController@verify_email');

        Route::post('forgot-password', 'ForgotPassword@reset_password_request');
        Route::post('verify-otp', 'ForgotPassword@otp_verification_submit');
        Route::put('reset-password', 'ForgotPassword@reset_password_submit');

        Route::any('social-login', 'SocialAuthController@social_login');
        Route::post('update-phone', 'SocialAuthController@update_phone');
    });

    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
    });

    Route::group(['prefix' => 'shipping-method','middleware'=>'auth:api'], function () {
        Route::get('detail/{id}', 'ShippingMethodController@get_shipping_method_info');
        Route::get('by-seller/{id}/{seller_is}', 'ShippingMethodController@shipping_methods_by_seller');
        Route::post('choose-for-order', 'ShippingMethodController@choose_for_order');
        Route::get('chosen', 'ShippingMethodController@chosen_shipping_methods');

        Route::get('check-shipping-type','ShippingMethodController@check_shipping_type');
    });

    Route::group(['prefix' => 'cart','middleware'=>'auth:api'], function () {
        Route::get('/', 'CartController@cart');
        Route::post('add', 'CartController@add_to_cart');
        Route::put('update', 'CartController@update_cart');
        Route::delete('remove', 'CartController@remove_from_cart');
        Route::delete('remove-all','CartController@remove_all_from_cart');

    });

    Route::get('faq', 'GeneralController@faq');

    Route::group(['prefix' => 'products'], function () {
        Route::get('latest', 'ProductController@get_latest_products');
        Route::get('featured', 'ProductController@get_featured_products');
        Route::get('top-rated', 'ProductController@get_top_rated_products');
        Route::any('search', 'ProductController@get_searched_products');
        Route::get('details/{slug}', 'ProductController@get_product');
        Route::get('related-products/{product_id}', 'ProductController@get_related_products');
        Route::get('reviews/{product_id}', 'ProductController@get_product_reviews');
        Route::get('rating/{product_id}', 'ProductController@get_product_rating');
        Route::get('counter/{product_id}', 'ProductController@counter');
        Route::get('shipping-methods', 'ProductController@get_shipping_methods');
        Route::get('social-share-link/{product_id}', 'ProductController@social_share_link');
        Route::post('reviews/submit', 'ProductController@submit_product_review')->middleware('auth:api');
        Route::get('best-sellings', 'ProductController@get_best_sellings');
        Route::get('home-categories', 'ProductController@get_home_categories');
        Route::get('discounted-product', 'ProductController@get_discounted_product');
        
        
        //new addition
        Route::get('trading-latest', 'ProductController@get_latest_trading_products');
        Route::get('trading-top-rated', 'ProductController@get_top_rated_trading_products');
        Route::get('trading-best-sellings', 'ProductController@get_best_sellings_trading');
        Route::get('trading-discounted-product', 'ProductController@get_discounted_trading_product');
        Route::get('trading-details/{slug}', 'ProductController@get_trading_product');
        Route::get('trading-social-share-link/{product_id}', 'ProductController@trading_social_share_link');
        Route::get('trading-related-products/{product_id}', 'ProductController@get_related_trading_products');
        
        
        
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@get_notifications');
    });

    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'BrandController@get_brands');
        Route::get('products/{brand_id}', 'BrandController@get_products');
        //new addition
        Route::get('trading-products/{brand_id}', 'BrandController@get_trading_products');
    });

    Route::group(['prefix' => 'attributes'], function () {
        Route::get('/', 'AttributeController@get_attributes');
    });

    Route::group(['prefix' => 'flash-deals'], function () {
        Route::get('/', 'FlashDealController@get_flash_deal');
        Route::get('products/{deal_id}', 'FlashDealController@get_products');
    });

    Route::group(['prefix' => 'deals'], function () {
        Route::get('featured', 'DealController@get_featured_deal');
    });

    Route::group(['prefix' => 'dealsoftheday'], function () {
        Route::get('deal-of-the-day', 'DealOfTheDayController@get_deal_of_the_day_product');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('products/{category_id}', 'CategoryController@get_products');
        //new adition 
        Route::get('trading-products/{category_id}', 'CategoryController@get_trading_products');
    });
    
    
    //====================================== Trading Api impementation =========================================================//
    
        //categories 
        Route::group(['prefix' => 'trading-categories'], function () {
            Route::get('/', 'CategoryController@get_trading_categories');
            Route::get('products/{category_id}', 'CategoryController@get_trading_products');
        });
        
        //Breed 
        Route::group(['prefix' => 'trading-breed'], function () {
            Route::get('/', 'CategoryController@get_trading_breed');
            Route::get('products/{category_id}', 'CategoryController@get_breed_products');
        });
        
        //Attributes
        Route::group(['prefix' => 'trading-attributes'], function () {
            Route::get('/', 'AttributeController@get_trading_attributes');
        });
        
        
        //Trading Products 
        
        Route::group(['prefix' => 'trading-products'], function () {
        Route::get('latest', 'TradingProductController@get_latest_products');
        Route::get('featured', 'TradingProductController@get_featured_products');
        Route::get('top-rated', 'TradingProductController@get_top_rated_products');
        Route::any('search', 'TradingProductController@get_searched_products');
        Route::get('details/{slug}', 'TradingProductController@get_product');
        Route::get('related-products/{product_id}', 'TradingProductController@get_related_products');
        Route::get('reviews/{product_id}', 'TradingProductController@get_product_reviews');
        Route::get('rating/{product_id}', 'TradingProductController@get_product_rating');
        Route::get('counter/{product_id}', 'TradingProductController@counter');
        Route::get('shipping-methods', 'TradingProductController@get_shipping_methods');
        Route::get('social-share-link/{product_id}', 'TradingProductController@social_share_link');
        Route::post('reviews/submit', 'TradingProductController@submit_product_review')->middleware('auth:api');
        Route::get('best-sellings', 'TradingProductController@get_best_sellings');
        Route::get('home-categories', 'TradingProductController@get_home_categories');
        Route::get('discounted-product', 'TradingProductController@get_discounted_product');
      });
    
    
      
      Route::group(['prefix' => 'user-seller', 'namespace' => 'user-seller'], function () {

        Route::get('seller-info', 'SellerUserController@seller_info');
        Route::get('account-delete','SellerUserController@account_delete');
        Route::get('seller-delivery-man', 'SellerUserController@seller_delivery_man');
        Route::get('shop-product-reviews', 'SellerUserController@shop_product_reviews');
        Route::get('shop-product-reviews-status','SellerUserController@shop_product_reviews_status');
        Route::put('seller-update', 'SellerUserController@seller_info_update');
        Route::get('monthly-earning', 'SellerUserController@monthly_earning');
        Route::get('monthly-commission-given', 'SellerUserController@monthly_commission_given');
        Route::put('cm-firebase-token', 'SellerUserController@update_cm_firebase_token');

        Route::get('shop-info', 'SellerUserController@shop_info_trading');
        
        //Route::get('shop-info-trading', 'SellerUserController@shop_info_trading');//NEW ADDITION
        
        Route::get('transactions', 'SellerUserController@transaction');
        Route::put('shop-update', 'SellerUserController@shop_info_update');

        Route::post('balance-withdraw', 'SellerUserController@withdraw_request');
        Route::delete('close-withdraw-request', 'SellerUserController@close_withdraw_request');

        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandController@getBrands');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::post('upload-images', 'ProductController@upload_images');
            Route::post('upload-digital-product', 'ProductController@upload_digital_product');
            Route::post('add', 'ProductController@add_new');
            Route::get('list', 'ProductController@list');
            Route::get('stock-out-list', 'ProductController@stock_out_list');
            Route::get('status-update','ProductController@status_update');
            Route::get('edit/{id}', 'ProductController@edit');
            Route::put('update/{id}', 'ProductController@update');
            Route::delete('delete/{id}', 'ProductController@delete');
            Route::get('barcode/generate', 'ProductController@barcode_generate');
        });

        // Route::group(['prefix' => 'orders'], function () {
        //     Route::get('list', 'OrderController@list');
        //     Route::get('/{id}', 'OrderController@details');
        //     Route::put('order-detail-status/{id}', 'OrderController@order_detail_status');
        //     Route::put('assign-delivery-man', 'OrderController@assign_delivery_man');
        //     Route::put('order-wise-product-upload', 'OrderController@digital_file_upload_after_sell');
        //     Route::put('delivery-charge-date-update', 'OrderController@amount_date_update');

        //     Route::post('assign-third-party-delivery','OrderController@assign_third_party_delivery');
        //     Route::post('update-payment-status','OrderController@update_payment_status');
        // });
        // Route::group(['prefix' => 'refund'], function () {
        //     Route::get('list', 'RefundController@list');
        //     Route::get('refund-details', 'RefundController@refund_details');
        //     Route::post('refund-status-update', 'RefundController@refund_status_update');

        // });

        // Route::group(['prefix' => 'shipping'], function () {
        //     Route::get('get-shipping-method', 'shippingController@get_shipping_type');
        //     Route::get('selected-shipping-method', 'shippingController@selected_shipping_type');
        //     Route::get('all-category-cost','shippingController@all_category_cost');
        //     Route::post('set-category-cost','shippingController@set_category_cost');
        // });

        // Route::group(['prefix' => 'shipping-method'], function () {
        //     Route::get('list', 'ShippingMethodController@list');
        //     Route::post('add', 'ShippingMethodController@store');
        //     Route::get('edit/{id}', 'ShippingMethodController@edit');
        //     Route::put('status', 'ShippingMethodController@status_update');
        //     Route::put('update/{id}', 'ShippingMethodController@update');
        //     Route::delete('delete/{id}', 'ShippingMethodController@delete');
        // });

        // Route::group(['prefix' => 'messages'], function () {
        //     Route::get('list/{type}', 'ChatController@list');
        //     Route::get('get-message/{type}/{id}', 'ChatController@get_message');
        //     Route::post('send/{type}', 'ChatController@send_message');
        //     Route::get('search/{type}', 'ChatController@search');
        // });

        // Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
        //     Route::post('login', 'LoginController@login');

        //     Route::post('forgot-password', 'ForgotPasswordController@reset_password_request');
        //     Route::post('verify-otp', 'ForgotPasswordController@otp_verification_submit');
        //     Route::put('reset-password', 'ForgotPasswordController@reset_password_submit');
        // });

        // Route::group(['prefix' => 'registration', 'namespace' => 'auth'], function () {
        //     Route::post('/', 'RegisterController@store');
        // });
    });
    
    
    //============================================ End of Trading Api Implementation ==============================================================================//
    
    
    
    

    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('info', 'CustomerController@info');
        Route::put('update-profile', 'CustomerController@update_profile');
        Route::put('cm-firebase-token', 'CustomerController@update_cm_firebase_token');
        Route::get('account-delete/{id}','CustomerController@account_delete');

        Route::get('get-restricted-country-list','CustomerController@get_restricted_country_list');
        Route::get('get-restricted-zip-list','CustomerController@get_restricted_zip_list');

        Route::group(['prefix' => 'address'], function () {
            Route::get('list', 'CustomerController@address_list');
            Route::get('get/{id}', 'CustomerController@get_address');
            Route::post('add', 'CustomerController@add_new_address');
            Route::put('update', 'CustomerController@update_address');
            Route::delete('/', 'CustomerController@delete_address');
        });

        Route::group(['prefix' => 'support-ticket'], function () {
            Route::post('create', 'CustomerController@create_support_ticket');
            Route::get('get', 'CustomerController@get_support_tickets');
            Route::get('conv/{ticket_id}', 'CustomerController@get_support_ticket_conv');
            Route::post('reply/{ticket_id}', 'CustomerController@reply_support_ticket');
        });

        Route::group(['prefix' => 'wish-list'], function () {
            Route::get('/', 'CustomerController@wish_list');
            Route::post('add', 'CustomerController@add_to_wishlist');
            Route::delete('remove', 'CustomerController@remove_from_wishlist');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'CustomerController@get_order_list');
            Route::get('details', 'CustomerController@get_order_details');
            Route::get('place', 'OrderController@place_order');
            Route::get('refund', 'OrderController@refund_request');
            Route::post('refund-store', 'OrderController@store_refund');
            Route::get('refund-details', 'OrderController@refund_details');
            Route::post('deliveryman-reviews/submit', 'ProductController@submit_deliveryman_review')->middleware('auth:api');
        });
        // Chatting
        Route::group(['prefix' => 'chat'], function () {
            Route::get('list/{type}', 'ChatController@list');
            Route::get('get-messages/{type}/{id}', 'ChatController@get_message');
            Route::post('send-message/{type}', 'ChatController@send_message');
        });

        //wallet
        Route::group(['prefix' => 'wallet'], function () {
            Route::get('list', 'UserWalletController@list');
        });
        //loyalty
        Route::group(['prefix' => 'loyalty'], function () {
            Route::get('list', 'UserLoyaltyController@list');
            Route::post('loyalty-exchange-currency', 'UserLoyaltyController@loyalty_exchange_currency');
        });
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('track', 'OrderController@track_order');
        Route::get('cancel-order','OrderController@order_cancel');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'seller'], function () {
        Route::get('/', 'SellerController@get_seller_info');
        Route::get('{seller_id}/products', 'SellerController@get_seller_products');
        Route::get('{seller_id}/all-products', 'SellerController@get_seller_all_products');
        Route::get('top', 'SellerController@get_top_sellers');
        Route::get('all', 'SellerController@get_all_sellers');
        
        //NEW ADDITION
        Route::get('{seller_id}/trading-all-products', 'SellerController@get_trading_seller_all_products');
        Route::get('trading-seller', 'SellerController@get_trading_seller_info');
    });

    Route::group(['prefix' => 'coupon','middleware' => 'auth:api'], function () {
        Route::get('apply', 'CouponController@apply');
    });



    //map api
    Route::group(['prefix' => 'mapapi'], function () {
        Route::get('place-api-autocomplete', 'MapApiController@place_api_autocomplete');
        Route::get('distance-api', 'MapApiController@distance_api');
        Route::get('place-api-details', 'MapApiController@place_api_details');
        Route::get('geocode-api', 'MapApiController@geocode_api');
    });
});
