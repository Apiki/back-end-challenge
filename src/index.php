<?php
/**
 * PHP version 8.1.6
 * 
 * @file index.php Doc Comment 
 * 
 * @category File
 * @package  Back_End_Challenge
 * @author   Werner Max <werner.max.bohling@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.apiki.com/
 */

require 'Exchange.php';

$exchange;
$erro = false;
try 
{
    $exchange = Exchange::getInstance();
    $exchange::getParametersAndConsist();
} 
catch (Exception) 
{
    $ret;
    $erro = true;
    header('HTTP/1.1 400 Bad Request');
    header("Content-Type: application/json;charset=utf-8");
    $ret = (object)array('valoConvertido'=>'', 'simboloMoeda'=>'');
    echo json_encode($ret, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
finally 
{
    $resp;
    if ($erro == false) {
        $resp = $exchange::converter();
        header('HTTP/1.1 200 OK');
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($resp, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    } 
}
exit;
?>
