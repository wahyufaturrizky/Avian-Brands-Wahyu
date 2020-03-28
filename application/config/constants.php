<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| OTHER CONSTANT
|--------------------------------------------------------------------------
|
|
*/
define("VERSION", "1.23");

//web base URL.
define("WEB_BASE_URL", "http://avianupnew.digistyles.com");

//-- DEFAULT PAGER AND LIMIT
define("PAGER_PAGE_LIMIT", 20);
define("LIMIT_SEARCH", 20);
define('DEFAULT_LINK_VALUE', 'javascript:void(0);');
define("DEFAULT_TITLE_MANAGER", "Avian Website Manager Site");
define("DEFAULT_TITLE_FRONT", "Avian Visual Mapping FRONT");

define("SHA1TEXT", 'avianbrands$idev123@');
define("PASSWORD_FRONT", 'avianbrands$idev!0216@');

//image type width and height
define("UPLOAD_PATH", "upload");
define("UPLOAD_PATH_AWARDS", "upload/awards");

//-- FILES UPLOAD
define("FILE_TYPE_UPLOAD", "*");

define("MAX_UPLOAD_IMAGE_SIZE", 10485760);
define("MAX_UPLOAD_IMAGE_SIZE_IN_KB", 10240);
define("WORDS_MAX_UPLOAD_IMAGE_SIZE", "10 MB");

define("MAX_UPLOAD_FILE_SIZE", 104857600);
define("MAX_UPLOAD_FILE_SIZE_IN_KB", 102400);
define("WORDS_MAX_UPLOAD_FILE_SIZE", "100 MB");

define("MAX_IMPORT_FILE_SIZE", 5242880);
define("MAX_IMPORT_FILE_SIZE_IN_KB", 5120);
define("WORDS_MAX_IMPORT_FILE_SIZE", "5 MB");


//-- EMAIL
define("DEFAULT_EMAIL_FROM", "mail@avianbrands.com");
define("DEFAULT_EMAIL_FROM_NAME", "Avian Brands");
define("DEFAULT_EMAIL_RETURN_PATH", "mail@avianbrands.com");
define("OUR_EMAIL_ADDRESS", "mail@avianbrands.com");
define("OUR_COMPANY_NAME", "Avian Brands");

define("SUBJECT_RESET_PASSWORD", "Avian Brands - Reset Password Information");
define("SUBJECT_PASSWORD_INFO", "Avian Brands - Password Information");
define("SUBJECT_LOGIN_INFO", "Avian Brands - Login Information");

define("SUBJECT_USER_REGISTRATION", "Avian Brands - Selamat datang di avian website");
define("SUBJECT_RESETED_PASSWORD", "Avian Brands - Password anda telah di reset");
define("SUBJECT_CONTACT_US_ADMIN", "[Baru] Kontak Dari Web Avian");
define("SUBJECT_CONTACT_US_USER", "Avian Brands - Terima kasih telah mengkontak kami");


//-- session
define("USER_SESSION","sess_login_user");
define("ADMIN_SESSION","sess_login_admin");
define("MENU_MINIFIED_MANAGER","menu_minified_manager");

//-- Active not active
define("STATUS_ALL",-1);
define("STATUS_DELETE",0);
define("STATUS_ACTIVE",1);

define("STATUS_HIDE",0);
define("STATUS_SHOW",1);

define("SHOW", 1);
define("HIDE", 0);

define("STICKIE_FLAG_YES", 1);
define("STICKIE_FLAG_NO", 0);

define("HOT_ITEM_YES", 1);
define("HOT_ITEM_NO", 0);

define ("CATEGORY",1);
define ("MENU",2);

define ("GUEST", 1);
define ("MEMBER", 2);

define ("SHOW_IN_ALL",1);
define ("SHOW_IN_USER",2);
define ("SHOW_IN_PRO",3);

define("TYPE_APPLICANT_ALL", 1);
define("TYPE_APPLICANT_ONE", 2);

define("LIKEBOX_PRODUCT",1);
define("LIKEBOX_COLOR",2);
define("LIKEBOX_STORE",3);
define("LIKEBOX_VISUALIZER",5);

//-- Manager breadcrumbs
define("MANAGER_HOME", '/manager');
define("MANAGER_HEADER", 'layout/headers/manager/header');
define("MANAGER_FOOTER", 'layout/footers/manager/footer');
define("MANAGER_HEADER_SIGNIN", 'layout/headers/manager/header_signin');
define("MANAGER_FOOTER_SIGNIN", 'layout/footers/manager/footer_signin');

//-- front
define("FRONT_HOME", '/');
define("FRONT_HEADER", 'layout/headers/front/header');
define("FRONT_FOOTER", 'layout/footers/front/footer');
define("FRONT_HEADER_SIGNIN", 'layout/headers/front/header_signin');
define("FRONT_FOOTER_SIGNIN", 'layout/footers/front/footer_signin');


define("FRONT_HEADER_2", 'layout/z_avian_new/avian_new_header');
define("FRONT_FOOTER_2", 'layout/z_avian_new/avian_new_footer');







//PEM , CERT
define ("PATH_TO_PEM_DEV", APPPATH. "/libraries/Push/avian-dev.pem");
define ("PATH_TO_PEM_PROD",APPPATH. "/libraries/Push/avian-prod.pem");
define ("PASS_PHRASE_DEV","avian1234");
define ("PASS_PHRASE_PROD","avian1234");
define ("GOOGLE_PUSH_API_KEY_DEV","AIzaSyABxIPPAnhMz7Kx9X51rBuVDct7TavpCX4");
define ("GOOGLE_PUSH_API_KEY_PROD","AIzaSyABxIPPAnhMz7Kx9X51rBuVDct7TavpCX4");

define ("GOOGLE_API_KEY","AIzaSyAdfB-1tzijt8NQRVY6SLNft9_JwxWxu1s");

define("API_KEY_AVIANVM", 'oiqh23987643..4b230-.23--$213.wfweaogn4');

define("PREFIX_API_KEY", 'AVM_');

// Only allow ajax requests
define ("ERROR_CODE_1",'Only AJAX requests are acceptable');
// Should we answer if not over SSL?
define ("ERROR_CODE_2",'Unsupported protocol');
//api key not valid
define ("ERROR_CODE_3",'Invalid API Key');
//api key dont have access to the requested controller.
define ("ERROR_CODE_4",'This API key does not have access to the requested controller.');
//if method is unknown
define ("ERROR_CODE_5",'Unknown method.');
//api key reach hourly limit
define ("ERROR_CODE_6",'This API key has reached the hourly limit for this method.');
// They don't have good enough perms
define ("ERROR_CODE_7",'This API key does not have enough permissions.');
// If the method doesn't exist
define ("ERROR_CODE_8",'Controller method does not exist.');
//if the user is logged in with a PHP session key and dont have session
define ("ERROR_CODE_9",'Not Authorized');
//not valid auth
define ("ERROR_CODE_10",'Invalid credentials');
//ip address is in white list (in rest config)
define ("ERROR_CODE_11",'IP not authorized');

//all parameter which required not sent
define ("ERROR_CODE_12",'%s is invalid.');
//member not found, email or password wrong,
define ("ERROR_CODE_13",'Email / Password salah');
//member has been deleted
define ("ERROR_CODE_14",'Member tidak ditemukan');
//email has been used
define ("ERROR_CODE_15",'Email telah terpakai');
//username has been used
define ("ERROR_CODE_16",'Username telah terpakai');
//password not same
define ("ERROR_CODE_17",'Password tidak sama');
define ("ERROR_CODE_18",'Visualisasi warna tidak ditemukan');
define ("ERROR_CODE_19",'Upload gambar tidak berhasil. Mohon untuk simpan kembali');
define ("ERROR_CODE_20",'Gagal. Mohon dicoba kembali.');
define ("ERROR_CODE_21",'Store Tidak ditemukan.');
define ("ERROR_CODE_22",'Products Tidak ditemukan.');
define ("ERROR_CODE_23",'Min. Score = 0, Max. Score = 5.');

define ("ERROR_CODE_24",'Point tidak cukup.');
define ("ERROR_CODE_25",'Voucher invalid atau pin merchant salah.');
define ("ERROR_CODE_26",'Stok voucher habis atau voucher sudah tidak dijual lagi.');
define ("ERROR_CODE_27",'Old password is wrong.');
define ("ERROR_CODE_30",'Missing Parameter.');

//user buy voucher
define("BUY", "User buy voucher");

//status claimed
define("STATUS_VOUCHER_BOUGHT", 0);
define("STATUS_VOUCHER_CLAIMED", 1);

// POINT Code
define ("CODE_LOGIN_DAILY", 'login_daily');
define ("CODE_REGISTER", 'register');
define ("CODE_STORE_REVIEW", 'store_review');
define ("CODE_STORE_DISCUSS", 'store_discuss');
define ("CODE_PRODUCT_REVIEW", 'product_review');
define ("CODE_PRODUCT_DISCUSS", 'product_discuss');
define ("CODE_SNS_SHARE", 'sns_share');
// Value of POINT
define ("POINT_LOGIN_DAILY", 10);
define ("POINT_REGISTER", 20);
define ("POINT_STORE_REVIEW", 5);
define ("POINT_STORE_DISCUSS", 1);
define ("POINT_PRODUCT_REVIEW", 7);
define ("POINT_PRODUCT_DISCUSS", 3);
define ("POINT_SNS_SHARE", 4);
// Description of POINT
define ("DESC_LOGIN_DAILY",'By login daily, user can get point.');
define ("DESC_REGISTER",'By registering, user can get point, but 1 time only.');
define ("DESC_STORE_REVIEW",'Giving review to store, user can get point 1 time per store.');
define ("DESC_STORE_DISCUSS",'Making discussion or replying can get point too.');
define ("DESC_PRODUCT_REVIEW",'Giving review to product, user can get point 1 time per product.');
define ("DESC_PRODUCT_DISCUSS",'Making discussion or replying can get point too.');
define ("DESC_SNS_SHARE",'When user share something to sns, will get this point for each.');
define ("DESCRIPTION", "Members have purchased");
