<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Start extends Model
{
    private $db;

    public function __construct()
    {
       $this->db = new Model();
    }
    
    public function getSettings() // Get global settings
    {
        $results = $this->db->select('everything_settings', 'id = 1 LIMIT 1');
        return $results;
    }
    
    public function getCountries($popular = '') // Get countries & popular countries
    {
		if ($popular != '') {
			$results = $this->db->select('everything_countries', 'status = 1 AND popular >= 1 ORDER BY popular');
        } else {
			$results = $this->db->select('everything_countries', 'status = 1 ORDER BY country_name ASC');
        }
		return $results;
    }
    
    public function getCountryName($country_code) // Get user country by country code
    {
        $bind = [':country_code' => $country_code];
        $results = $this->db->select('everything_countries', 'country_code = :country_code', $bind);
        return $results[0]['country_name'];
    }
    
	public function getEmailData($type) // Get email template data
    {
        $bind = [':type' => $type];
        $results = $this->db->select('everything_email_templates', 'type = :type', $bind);
        return $results;
    }

}