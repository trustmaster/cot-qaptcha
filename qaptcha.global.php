<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=qaptcha
Part=functions
File=qaptcha.global
Hooks=global
Tags=
Order=10
[END_SED_EXTPLUGIN]

==================== */

/**
 * QAPTCHA
 *
 * @package Cotonti
 * @version 0.0.4
 * @author esclkm
 * @copyright Copyright (c) Mikulik Pavel 2008-2009
 * @license BSD
 */

if (!defined('SED_CODE')) { die("Wrong URL."); }

$db_qaptcha = 'sed_qaptcha';
function qaptcha_validate($verify=0)
{
    global $db_qaptcha;
    $rqstid = sed_import('rqstid', 'P', 'INT');
    $qst_sql = @sed_sql_query("SELECT * FROM $db_qaptcha WHERE qst_id = $rqstid");
    $qst = @sed_sql_fetcharray($qst_sql);
    return mb_strtoupper($verify) == mb_strtoupper($qst['qst_answer']);
}

function qaptcha_generate()
{
    global $db_qaptcha;
    $qst_sql = @sed_sql_query("SELECT * FROM $db_qaptcha WHERE qst_id >= (SELECT FLOOR(MAX(qst_id) * RAND()) FROM $db_qaptcha) ORDER BY qst_id LIMIT 1");
    if($qst = sed_sql_fetcharray($qst_sql))
    {
        $verifyimg = '<input type="hidden" name="rqstid" value="'.$qst['qst_id'].'" />'.$qst['qst_text'];
    }
    return ($verifyimg);
}

$sed_captcha[]='qaptcha';

?>
