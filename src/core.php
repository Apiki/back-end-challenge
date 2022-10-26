<?php
/**
 * Core Class for API routines
 *
 * PHP version 7.4
 *
 * @category Backend_Challenge
 * @package  Back-end-challenge
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/fabianoone/back-end-challenge
 */
require 'request.php';
require 'controller.php';

$response = [];

$req = new request;

[$method, $data] = $req->getUrl();

if (isset($method)) {
    $controller = new controller;
    $response = $controller->getRequest('_' . $method, $data);
} else {
    $response['ERRO'] = 'Method does not exist...';
}

$req->sendResponse($response);
