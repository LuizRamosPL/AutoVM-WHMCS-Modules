<?php
use WHMCS\Database\Capsule;
$path = dirname(__FILE__);

require $path . '/CloudSnpController.php';


// Create user tabel
function cloudsnp_activate()
{    

    $hasTable = Capsule::schema()->hasTable('autovm_snp_user');

    if (empty($hasTable)) {

        Capsule::schema()->create('autovm_snp_user', function ($table) {

            $table->increments('id');
            $table->string('user_id');
            $table->string('token');
        });
    }

    $hasTable = Capsule::schema()->hasTable('autovm_snp_order');

    if (empty($hasTable)) {

        Capsule::schema()->create('autovm_snp_order', function ($table) {

            $table->increments('id');
            $table->string('order_id');
            $table->string('machine_id');
        });
    }

    $pdo = Capsule::connection()->getPdo();
    $pdo->exec('ALTER TABLE tblcurrencies MODIFY rate decimal(10, 10)');
}

// Set Module parameters, name, describ or so ..
function cloudsnp_config()
{

    $ResellerBackendUrlLabel = 'Insert Reseller Backend Address, started with http, default is "https://api.cloudsnp.net"';
    $ResellerTokenLabel = 'Insert your Reseller Token here, as an Example "de8fs953k49ho3ellg9x", You can request for your Reseller Token on "https://my.cloudsnp.net/"';
    $DefLangLabel = 'Select a language as default language for admin and users panel, this language setting is for AutoVM Module and has nothing to do with WHMCS language setting';

    $AutovmDefaultCurrencyID = 'Insert Id of your currency for cloud';
    $AutovmDefaultCurrencySymbol = 'Insert Symbol of your currency for cloud';
    $PlaceCurrencySymbol = 'Select between "suffix" or "prefix" or "code" as the place of symbol in your currency setting';
    $ShowExchange = 'Select "on" to enable showing Ratio and Conversion exchanges';
    $ChargeModuleEnable = 'Select "on" to enable direct charging module';
    $ConsoleRoute = 'This is usually is domain of your WHMCS added to /console e.q. "https://www.mywhmcs.com/console"';
    $TopupLink = 'This is usually one of your pages that user can increase their credit, default is "/clientarea.php?action=addfunds"';
    $AdminUserSummeryPagePath = 'This is the url of user sumery page in admin panel, if you did not changed it, it will be like this "/admin/clientssummary.php"';
    $minimumChargeInAutovmCurrency = 'The least amount a user can charge its own cloud balance';
    $DefaultMonthlyDecimal = 'Insert the decimal for Cost Monthly in cloud currency';
    $DefaultHourlyDecimal = 'Insert the decimal for Cost Hourly in cloud currency';
    $DefaultBalanceDecimalWhmcs = 'Insert the decimal for Balance in User Currency';
    $DefaultBalanceDecimalCloud = 'Insert the decimal for Balance in cloud currency';
    $DefaultChargeAmountDecimalWhmcs = 'Insert the decimal for Charge amount in user currency';
    $DefaultChargeAmountDecimalCloud = 'Insert the decimal for Charge amount in cloud currency';
    $DefaultCreditDecimalWhmcs = 'Insert the decimal for Credit in user currency';
    $DefaultCreditDecimalCloud = 'Insert the decimal for Credit in cloud currency';
    $DefaultMinimumDecimalWhmcs = 'Insert the decimal for Minimum Charge Amount in user currency';
    $DefaultMinimumDecimalCloud = 'Insert the decimal for Minimum Charge Amount in cloud currency';
    $DefaultRatioDecimal = 'Insert the decimal for Ratio';
    
    $decimalOptions = array (
        'option1' => 0,
        'option2' => 1,
        'option3' => 2,
    );

    $OnOffOption = array(
        'option1' => 'on',
        'option2' => 'off',
    );
    
    $CurrencyPlaceOption = array(
        'option1' => 'code',
        'option2' => 'suffix',
        'option3' => 'prefix',
    );

    $configarray = array(
        "name" => "Cloud SNP",
        "description" => "Cloud SNP Module By AutoVM",
        "version" => "V01.01.02",
        "author" => "autovm.net",
        "fields" => array(
            "ResellerBackendUrl" => array ("FriendlyName" => "Reseller Backend Url", "Type" => "text", "Size" => "31", "Description" => $ResellerBackendUrlLabel, "Default" => "https://api.cloudsnp.net"),
            "ResellerToken" => array ("FriendlyName" => "Your Reseller Token", "Type" => "text", "Size" => "31", "Description" => $ResellerTokenLabel, "Default" => "xxxx"),
            "DefLang" => array ("FriendlyName" => "Default Language for cloud panel", "Type" => "dropdown", "Options" => "English, Farsi, Turkish, Russian, Deutsch, French, Brizilian, Italian", "Description" => $DefLangLabel, "Default" => "English"),

            "AutovmDefaultCurrencyID" => array ("FriendlyName" => "CloudSNP Currency ID", "Type" => "text", "Size" => "31", "Description" => $AutovmDefaultCurrencyID, "Default" => 1),
            "AutovmDefaultCurrencySymbol" => array ("FriendlyName" => "CloudSNP Currency Symbol", "Type" => "text", "Size" => "31", "Description" => $AutovmDefaultCurrencySymbol, "Default" => "$"),
            "PlaceCurrencySymbol" => array ("FriendlyName" => "Currency Placeholder", "Type" => "dropdown", 'Options' => $CurrencyPlaceOption, "Default" => 'option3', "Description" => $PlaceCurrencySymbol),
            "ShowExchange" => array ("FriendlyName" => "Show Exchange", "Type" => "dropdown", 'Options' => $OnOffOption, "Default" => 'option2', "Description" => $ShowExchange),
            "ChargeModuleEnable" => array ("FriendlyName" => "Enable Charging Module", "Type" => "dropdown", 'Options' => $OnOffOption, "Default" => 'option1', "Description" => $ChargeModuleEnable),
            "ConsoleRoute" => array ("FriendlyName" => "Console Route", "Type" => "text", "Size" => "31", "Description" => $ConsoleRoute, "Default" => "https://www.mywhmcs.com/console"),
            "TopupLink" => array ("FriendlyName" => "Topup page Link", "Type" => "text", "Size" => "31", "Description" => $TopupLink, "Default" => "/clientarea.php?action=addfunds"),
            "AdminUserSummeryPagePath" => array ("FriendlyName" => "User Summery Page address in panel admin", "Type" => "text", "Size" => "51", "Description" => $AdminUserSummeryPagePath, "Default" => "/admin/clientssummary.php"),
            "minimumChargeInAutovmCurrency" => array ("FriendlyName" => "Minumum charge allowed in cloud currency", "Type" => "text", "Size" => "31", "Description" => $minimumChargeInAutovmCurrency, "Default" => "2"),
            "DefaultMonthlyDecimal" => array ("FriendlyName" => "Cost Decimal Monthly in User Currency", "Type" => "dropdown",'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultMonthlyDecimal),
            "DefaultHourlyDecimal" => array ("FriendlyName" => "Cost Decimal hourly in User Currency", "Type" => "dropdown",'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultHourlyDecimal),
            "DefaultBalanceDecimalWhmcs" => array ("FriendlyName" => "Balance Decimal in User Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultBalanceDecimalWhmcs),
            "DefaultBalanceDecimalCloud" => array ("FriendlyName" => "Balance Decimal in Cloud Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultBalanceDecimalCloud),
            "DefaultChargeAmountDecimalWhmcs" => array ("FriendlyName" => "Charge Amount Decimal in User Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultChargeAmountDecimalWhmcs),
            "DefaultChargeAmountDecimalCloud" => array ("FriendlyName" => "Charge Amount Decimal in Cloud Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultChargeAmountDecimalCloud),
            "DefaultCreditDecimalWhmcs" => array ("FriendlyName" => "Credit Decimal in User Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultCreditDecimalWhmcs),
            "DefaultCreditDecimalCloud" => array ("FriendlyName" => "Credit Decimal in Cloud Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultCreditDecimalCloud),
            "DefaultMinimumDecimalWhmcs" => array ("FriendlyName" => "Minimum charge amount Decimal in User Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultMinimumDecimalWhmcs),
            "DefaultMinimumDecimalCloud" => array ("FriendlyName" => "Minimum charge amount Decimal in Cloud Currency", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultMinimumDecimalCloud),
            "DefaultRatioDecimal" => array ("FriendlyName" => "Exchange Rate Decimal", "Type" => "dropdown", 'Options' => $decimalOptions, "Default" => 'option1', "Description" => $DefaultRatioDecimal),
        ));
        return $configarray;

}

function autovm_get_ResellerToken_baseurl_cloudsnp(){
    $response = [];

    try {
        $moduleparams = Capsule::table('tbladdonmodules')->get();
        foreach ($moduleparams as $item) {
            if($item->module == 'cloudsnp'){
                if($item->setting == 'ResellerBackendUrl'){
                    $ResellerBackendUrl = $item->value;
                }
                
                if($item->setting == 'ResellerToken'){
                    $ResellerToken = $item->value;
                }

                if($item->setting == 'DefLang'){
                    $DefLang = $item->value;
                }
            }
        }
    } catch (\Exception $e) {
        $error = 'Database ERR ===> Client: Can not find module params table in database';
        $response['error'] = $error;
        return $response;
    }

    if(empty($ResellerBackendUrl)){
        $message = 'Backend URL ERR ===> Go to addons module and insert your backend adrress';
        $response['message'] = $message;
        return $response;
    }
    
    if(empty($ResellerToken)){
        $message = 'Reseller Token ERR ===> Go to addons module and insert your Token';
        $response['message'] = $message;
        return $response;
    }
   
    if(empty($DefLang)){
        $message = 'Defaul Language ERR ===> Go to addons module and select a language';
        $response['message'] = $message;
        return $response;
    }


    if(!empty($DefLang)){
        if(empty($_COOKIE['temlangcookie']) && !headers_sent()) {
            setcookie('temlangcookie', $DefLang, time() + (86400 * 30 * 12), '/');
        }
    }
    
    
    if(isset($ResellerToken) && isset($ResellerBackendUrl) && isset($DefLang)){
        $response['ResellerToken'] = $ResellerToken;
        $response['ResellerBackendUrl'] = $ResellerBackendUrl;
        $response['DefLang'] = $DefLang;
        return $response;
    } 
}

// Get Token From AutoVm module
function autovm_get_config_cloudsnp(){
    $response = [];
    $requiredKeys = [
        'AutovmDefaultCurrencyID' => null,
        'AutovmDefaultCurrencySymbol' => null,
        'PlaceCurrencySymbol' => null,
        'ShowExchange' => null,
        'ChargeModuleEnable' => null,
        'ConsoleRoute' => null,
        'TopupLink' => null,
        'AdminUserSummeryPagePath' => null,
        'minimumChargeInAutovmCurrency' => null,
        'DefaultMonthlyDecimal' => null,
        'DefaultHourlyDecimal' => null,
        'DefaultBalanceDecimalWhmcs' => null,
        'DefaultBalanceDecimalCloud' => null,
        'DefaultChargeAmountDecimalWhmcs' => null,
        'DefaultChargeAmountDecimalCloud' => null,
        'DefaultCreditDecimalWhmcs' => null,
        'DefaultCreditDecimalCloud' => null,
        'DefaultMinimumDecimalWhmcs' => null,
        'DefaultMinimumDecimalCloud' => null,
        'DefaultRatioDecimal' => null,
    ];

    try {
        $moduleparams = Capsule::table('tbladdonmodules')->get();
        foreach ($moduleparams as $item) {
            if($item->module == 'cloudsnp'){
                foreach ($requiredKeys as $key => $value) {
                    if ($item->setting == $key) {
                        if(!empty($item->value)){
                            $requiredKeys[$key] = $item->value;
                        } else {
                            $response['message'] = "$key has no value";
                            return $response;
                        }
                    }
                }
            }
        }
    } catch (\Exception $e) {
        $error = 'Cloud Config ERR ===> Can not find module params table in database';
        $response['error'] = $error;
        return $response;
    }

    foreach ($requiredKeys as $key => $value){
        if(isset($requiredKeys[$key])){
            $response[$key] = $value;
        } 
    }
    
    $variables = $requiredKeys;
    cloudsnp_create_config_file($variables);

    return $response;
}

// Add functionality to client area env
function cloudsnp_create_config_file($variables){
    
    $configFilePath = __DIR__ . '/views/autovm/includes/commodules/vitalvariable.php';
    $configArray = $variables;
    
    // Write the array to the configuration file
    file_put_contents($configFilePath, '<?php return ' . var_export($configArray, true) . ';');
}


function autovm_set_language($lang){
    if(empty($lang)){
        $lang = 'English';
    }

    if(($lang != 'English' && $lang != 'Farsi' && $lang != 'Turkish' && $lang != 'Russian' && $lang != 'Deutsch' && $lang != 'French' && $lang != 'Brizilian' && $lang != 'Italian')){
        $lang = 'English';
    }

    if(!empty($lang)){
        if(empty($_COOKIE['temlangcookie']) && !headers_sent()) {
            setcookie('temlangcookie', $lang, time() + (86400 * 30 * 12), '/');
        }
    }
}

// Run in client Page to start controller class [CloudController]
function cloudsnp_clientarea($vars)
{

    $response = autovm_get_ResellerToken_baseurl_cloudsnp();
    
    if(isset($response['ResellerToken']) && isset($response['ResellerBackendUrl']) && isset($response['DefLang'])){
        $ResellerToken = $response['ResellerToken'];
        $ResellerBackendUrl = $response['ResellerBackendUrl'];
        $DefLang = $response['DefLang'];
    } 


    if(!empty($DefLang)){
        autovm_set_language($DefLang);
    }
    
    
    $action = autovm_get_query('action');
    $clientId = autovm_get_session('uid');

    if(!empty($clientId) && !empty($ResellerToken) && !empty($ResellerBackendUrl)) {
        autovm_get_config_cloudsnp();

        try {
            $controller = new CloudSnpController($clientId, $ResellerToken, $ResellerBackendUrl);
            return $controller->handle($action);
        } catch (Exception $e) {
            return "Error";
        }
    } else {
        echo "Error: Missing required parameters";
    }

}

// Show in admin panel in addon menu page
function cloudsnp_output($vars) {
    $response = autovm_get_ResellerToken_baseurl_cloudsnp();

    if(!empty($vars['version'])){
        $version = $vars['version'];
        $text = '<h2> Version : ' . $version . '</h2>';
        echo($text);
    }
    
    if(!empty($response['DefLang'])){
        $DefLang = $response['DefLang'];
        $text = '<h3> Default Language : ' . $DefLang . '</h3>';
        echo($text);
    }

    if(!empty($response['ResellerBackendUrl'])){
        $ResellerBackendUrl = $response['ResellerBackendUrl'];
        $text = '<h3> Reseller Backedn URL: ' . $ResellerBackendUrl . '</h3>';
        echo($text);
    }


    $text = '
            <p style="padding: 50px 0px 0px 0px; !important">
            <span style="font-weight: 800 !important;">AutoVM Cloud SNP</span> is a module to facilitate connection to AUTOVM Backend from WHMCS to have a smart way to easily manage your clients and their machines within WHMCS environment.
            </p>
        ';
    echo($text);
    
    $text = '
        <p>
        You can always get the latest version from the <a href="https://github.com/autovm-modules/CloudSNP-WHMCS-Module" style="font-weight: 800 !important;" target="_blank">AutoVM CloudSNP git repository</a>
        </p>
        <p>
        To learn how to use AutoVM modules, please check out the <a href="https://AutoVM.net/docs/" style="font-weight: 800 !important;" target="_blank"> AutoVM documentation page</a>
        </p>
        ';
    echo($text);


    // show Messgaes
    if(!empty($response['message'])){
        echo('<pre style="padding: 20px 20px 20px 20px; margin: 30px 0px 30px 0px">');
        print_r($response['message']);
        echo('</pre>');
    } 
    
    // show Errors
    if(!empty($response['error'])){
        echo('<pre style="padding: 20px 20px 20px 20px; margin: 30px 0px 30px 0px">');
        print_r($response['error']);
        echo('</pre>');
    } 
    
}



