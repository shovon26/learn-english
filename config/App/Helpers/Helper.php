<?php

namespace App\Helpers;
use App\DataModel\Manager\SessionManager;
use App\DataModel\Model\ROMArray;

function asset($path, $secure = null)
{
    return app('url')->asset($path.'?ver='.config('app.version'), $secure);
}
function moneyLocalization($expression)
{
    $currencyLocaleCode = 'bn_BD';
    $currency = (new SessionManager())->getSession('ownerController.currency');
    if ($currency) {
        $currencyLocaleCode = $currency["currencyLocaleCode"];
    }
    setlocale(LC_MONETARY, $currencyLocaleCode);
    if (function_exists('money_format')) {
        return money_format('%.2n',$expression);
    }
    return number_format($expression,'2','.',',');
}
function dateLocalization($expression)
{
    return date('d/m/Y',strtotime($expression));
}

function differenceBetweenDates($startDate,$endDate)
{
    $datetime1  = new \DateTime($startDate);
    $datetime2  = new \DateTime($endDate);
    $interval   = $datetime1->diff($datetime2);
    return $interval->days;
}

if (! function_exists('moneyFormat')) {
    /**
     * Format number to a particular currency.
     *
     * @param float Amount to format
     * @param string Currency
     * @return string
     */
    function moneyFormat($amount,$fraction_digits=2)
    {
//        $shopInfo           = (new ShopManager())->getShopByShopId(request()->get('shopId'));
//        $currencyLocaleCode = $shopInfo->getCurrencyLocaleCode();
        $currencyLocaleCode = "#06grg";

        if($currencyLocaleCode == 'bn_BD' OR $currencyLocaleCode == 'bn_BD.UTF-8')
        {
            $fmt = numfmt_create( 'en_US', \NumberFormatter::CURRENCY);
            $fmt->setPattern('৳#,##,##0.##');
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $fraction_digits);
        }
        else
        {
            $fmt = numfmt_create( $currencyLocaleCode, \NumberFormatter::CURRENCY );
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $fraction_digits);
        }
        return numfmt_format($fmt, $amount);

        //$oFormatter = numfmt_create( $currencyLocaleCode, \NumberFormatter::CURRENCY );
        //$symbol     = $oFormatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
        //$fmt->setPattern($oFormatter->getPattern());
        //$fmt->setAttribute(\NumberFormatter::FRACTION_DIGITS, 2);
    }
}


if (! function_exists('moneyFormatLocalization')) {
    /**
     * Format number to a particular currency.
     *
     * @param $amount
     * @param $fraction_digits
     * @param $currencyLocaleCode
     * @return string
     */
    function moneyFormatLocalization($amount, $fraction_digits = 2, $currencyLocaleCode = 'bn_BD.UTF-8')
    {
        if($currencyLocaleCode == 'bn_BD' OR $currencyLocaleCode == 'bn_BD.UTF-8')
        {
            $fmt = numfmt_create( 'en_US', \NumberFormatter::CURRENCY);
            $fmt->setPattern('৳#,##,##0.##');
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $fraction_digits);
        }
        else
        {
            $fmt = numfmt_create( $currencyLocaleCode, \NumberFormatter::CURRENCY );
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $fraction_digits);
        }
        return numfmt_format($fmt, $amount);
    }
}

function encrypt($data)
{
    return base64_encode(openssl_encrypt($data,"AES-128-ECB",ROMArray::$uniqueKey));
}

function decrypt($encrypted_data)
{
    return openssl_decrypt(base64_decode($encrypted_data),"AES-128-ECB",ROMArray::$uniqueKey);
}

if (!function_exists('errorMessage')) {
    function errorMessage($e)
    {
        return response()->json([
            "message" => "From Cache: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine()
        ], 500);
    }
}
if (!function_exists('customData')) {
    function customData($arrs, $key, $val = null) {
        $res = [];
        foreach($arrs as $arr) {
            if($val) {
                $res[$arr[$key]] = $arr[$val];
            } else {
                $res[$arr[$key]][] = $arr;
            }
        }
        return $res;
    }
}
