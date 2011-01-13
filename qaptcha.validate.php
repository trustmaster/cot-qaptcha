<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=qaptcha
Part=validate
File=qaptcha.validate
Hooks=users.register.add.first
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

$rverify  = sed_import('rverify','P','TXT');
require_once(sed_langfile('qaptcha'));
if(!function_exists(sed_captcha_validate))
{
    function sed_captcha_validate($verify = 0 ,$func_index = 0)
    {
        global $sed_captcha;
        if(!empty($sed_captcha[$func_index]))
        {
            $captcha=$sed_captcha[$func_index]."_validate";
            return $captcha($verify);
        }
        return false;
    }
}

$error_string .= sed_captcha_validate($rverify) ? '' : $L['captcha_verification_failed'].'<br />';

?>