<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class dateHelp
{
    public function __construct() 
    {
        // Empty constructor to avoid "Constructor cannot be static" error.
    }
    /*
     * @param $date
     * @return date
     *
     * Display date: April 22nd 2018.
     */
    public static function helper_format_date_1($date, $format = 'F jS Y')
    {
        return date( $format, strtotime($date) );
    }
    
    /*
     * @param $date
     * @return date
     *
     * Display date: Apr 2018.
     */
    public static function helper_format_date_2($date, $format = 'M Y')
    {
        return date( $format, strtotime($date) );
    }
    
    /*
     * @param $date
     * @return date
     *
     * Display date: 22 Apr 2018.
     */
    public static function helper_format_date_3($date, $format = 'j M Y')
    {
        return date( $format, strtotime($date) );
    }
    
    /*
     * @param $date
     * @return date
     *
     * Display date: April 22, 2018, 5:16 pm.
     */
    public static function helper_format_date_4($date, $format = 'F j, Y, g:i a')
    {
        return date( $format, strtotime($date) );
    }
    
    /*
     * @param $ptime
     * @return time ago
     *
     * Display time ago: 1 Second Ago, 1 Year Ago e.g. helper_format_date_5(strtotime($user['joined']));.
     */
    public static function helper_format_date_5($ptime)
    {
        $estimate_time = time() - $ptime;
        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
       );
       foreach($condition as $secs => $str) {
            $d = $estimate_time / $secs;
            if ($d >= 1) {
                $r = round($d);
                return '' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }
    
    /*
     * @param $date
     * @return date
     *
     * Display date: Sun, 22 Apr 2018 19:41:35
     */
    public static function helper_format_date_6($date, $format = 'r')
    {
        return date( $format, strtotime($date) );
    }
  
}