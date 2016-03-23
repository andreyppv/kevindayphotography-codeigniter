<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('current_url'))
{
    function current_url()
    {
        $CI =& get_instance();

        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
    }
}

if ( ! function_exists('admin_url'))
{
    function admin_url($uri='')
    {
        return site_url("admin/$uri");
    }
}

if ( ! function_exists('admin_uri'))
{
    function admin_uri($uri='')
    {
        return "admin/$uri";
    }
}

if ( ! function_exists('upload_url'))
{
    function upload_url($uri='')
    {
        return site_url(UPLOAD_PATH . "/$uri");
    }
}