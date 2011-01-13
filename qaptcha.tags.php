<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=qaptcha
Part=register
File=qaptcha.tags
Hooks=users.register.tags
Tags=users.register.tpl:{USERS_REGISTER_VERIFYIMG},{USERS_REGISTER_VERIFYINPUT}
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die("Wrong URL."); }
require_once(sed_langfile('qaptcha'));
$verifyinput = "<input name=\"rverify\" type=\"text\" id=\"rverify\" size=\"10\" maxlength=\"6\">";
if (!function_exists (sed_captcha_generate))
{
    function sed_captcha_generate($func_index = 0)
    {
        global $sed_captcha;
        if(!empty($sed_captcha[$func_index]))
        {
            $captcha=$sed_captcha[$func_index]."_generate";
            return $captcha();
        }
        return false;
    }
}
$t->assign(array(
    "USERS_REGISTER_VERIFYIMG" => sed_captcha_generate(),
    "USERS_REGISTER_VERIFYINPUT" => $verifyinput,
    ));

?>