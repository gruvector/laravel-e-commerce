<?php

namespace Modules\Support;

class RTLDetector
{
    private static $rtlLocales = [
        'ar',
        'ar_DZ',
        'ar_BH',
        'ar_TD',
        'ar_KM',
        'ar_DJ',
        'ar_EG',
        'ar_ER',
        'ar_IQ',
        'ar_IL',
        'ar_JO',
        'ar_KW',
        'ar_LB',
        'ar_LY',
        'ar_MR',
        'ar_MA',
        'ar_OM',
        'ar_PS',
        'ar_QA',
        'ar_SA',
        'ar_SO',
        'ar_SS',
        'ar_SD',
        'ar_SY',
        'ar_TN',
        'ar_AE',
        'ar_EH',
        'ar_YE',
        'arc',
        'dv',
        'fa',
        'fa_AF',
        'fa_IR',
        'ha',
        'ha_GH',
        'ha_Latn_GH',
        'ha_Latn_NE',
        'ha_Latn_NG',
        'ha_Latn',
        'ha_NE',
        'ha_NG',
        'he',
        'he_IL',
        'khw',
        'ks',
        'ks_Arab_IN',
        'ks_Arab',
        'ks_IN',
        'ku',
        'ps',
        'ps_AF',
        'ur',
        'ur_IN',
        'ur_PK',
        'yi',
    ];

    public static function detect($locale)
    {
        return in_array($locale, self::$rtlLocales);
    }
}
