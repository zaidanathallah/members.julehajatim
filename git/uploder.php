<?php
/**
 * Compatibility Bridge untuk URL Legacy uploder.php
 * Mengarahkan pengunjung secara aman ke controller resmi CodeIgniter /members/uploder
 */
$id = isset($_GET['id']) ? preg_replace('/[^A-Za-z0-9_\-]/', '', $_GET['id']) : '';
if (empty($id) && isset($_GET['juleha_id'])) {
    $id = preg_replace('/[^A-Za-z0-9_\-]/', '', $_GET['juleha_id']);
}

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script_dir = isset($_SERVER['SCRIPT_NAME']) ? str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) : '/';
$base_url = rtrim($protocol . $host . $script_dir, '/') . '/';

$target = $id ? $base_url . 'members/uploder/' . $id : $base_url . 'members/uploder';
header('Location: ' . $target, true, 302);
exit;
