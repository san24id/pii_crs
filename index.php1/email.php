<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * Mailgun Configuration
 */
$config['protocol']         = 'smtp';
$config['smtp_host']        = 'ssl://smtp.mailgun.org';
$config['smtp_port']        = 465;
$config['smtp_user']        = 'postmaster@crm.barantum.com';
$config['smtp_pass']        = '0a818593f0ff19497d1171900246c1f1';
$config['smtp_crypto']      = '';
$config['charset']          = 'utf-8';
$config['mailtype']         = 'html';
$config['email']['newline'] = "rn";

?>