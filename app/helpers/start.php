<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class startHelp
{
    public function __construct() 
    {
        // Empty constructor to avoid "Constructor cannot be static" error.
    }
    
    /*
     * @param $page
     * URL Redirect.
     */
    public static function redirect($page)
    {
        header('location: ' . FULL_ROOT . '/' . $page);
    }
    
    /*
     * @param $name
     * @param $message
     * @param $class
     * @param $custom
     * @return message
     *
     * Controls Alert Message.
     */
    public static function flash($name, $message = '', $class = '', $custom = '')
    {
        if (isset($_SESSION[$name]) && empty($message)) {
            $value = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $value;
        } elseif (!empty($message)) {
            $message = $class && $custom ? "<div " . $custom . " class='fade show f-14 " . $class . "'><div class=\"container\"><i class=\"fas fa-info-circle mr-2\"></i> " . $message . "</div></div>" : "<div class='fade show f-14 " . $class . "'><div class=\"container\"><i class=\"fas fa-info-circle mr-2\"></i> " . $message . " <button type=\"button\" class=\"close alert-close-custom\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div></div>";
            return $_SESSION[$name] = $message;
        }
    }
    
    /*
     * Checks Login Authentication.
     */
    public static function isLoggedIn()
    {
        if (isset($_SESSION['upin']) && $_SESSION['uaccess'] == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * Checks Part-Login Authentication.
     */
    public static function isPartLoggedIn()
    {
        if (isset($_SESSION['upin']) && $_SESSION['uaccess'] == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * Checks Session Exists
     */
    public static function isSessionValid()
    {
        return isset($_SESSION) && isset($_SESSION['uaccess']);
    }
    
    /*
     * @param $length (default = 15)
     * @return randomString
     *
     * Generate Random String.
     */
    public static function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /*
     * @param $length
     * @param $keyspace
     * @return string
     *
     * Generate Cryptographically Secure Random String.
     */
    public static function generateCryptoRandomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
    
    /*
     * @param $url
     * @return clean url
     *
     * URL Cleanup.
     */
    public static function slugify($url)
    {
        $url = preg_replace('~[^\pL\d]+~u', '-', $url);
        $url = iconv('utf-8', 'us-ascii//TRANSLIT', $url);
        $url = preg_replace('~[^-\w]+~', '', $url);
        $url = trim($url, '-');
        $url = preg_replace('~-+~', '-', $url);
        $url = strtolower($url);
        if(empty($url)) {
            return 'n-a';
        }
        return $url;
    }
    
}