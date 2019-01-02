<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Csrf extends Model 
{
	public $token;
	private const TokenExpiry = 1800; // Token life in seconds (30 mins)
	private const RecentToken = 60 * 60 * 24; // Check token was recent (1 day)

	public function __construct() 
	{
		$this->db = new Model();
	}
	
	public function CSRFInput() // Display CSRF input
	{
		$this->CSRFTokenGeneration();
		$this->CSRFCheckGenerate();
		$_SESSION['csrf_expire_check'] = time();
        $_SESSION['testy'] = $this->token;
		echo '<input type="hidden" name="csrf_token" value="' . $this->token . '">';
	}

	protected function CSRFTokenGeneration() // Generate CSRF token
	{
		if (!isset($_SESSION['csrf_token'])) {
			$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
	}
	
	protected function CSRFCheckGenerate() // Check CSRF token exists then hash
	{
		if (isset($_SESSION['csrf_token'])) {
			$this->token = hash_hmac('sha256', __FILE__, $_SESSION['csrf_token']);
        } else {
			die(LANG['csrf-invalid']);
        }
	}
    
	protected function isCSRFTokenRecent() // Check CSRF token recent
	{
		if (isset($_SESSION['csrf_expire_check'])) {
			$stored_time = $_SESSION['csrf_expire_check'];
			return ($stored_time + self::RecentToken) >= time();
		} else {
			unset($_SESSION['csrf_token']);
			return false;
		}
	}
    
    protected function isCSRFSameReferer() // Check CSRF token sent from same domain
    {
        if ((isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))) {
            if (strtolower(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)) != strtolower($_SERVER['HTTP_HOST'])) {
                return false;
            }
        }
        return true;
    }

	public function CSRFTokenVerify() // Verify CSRF token
	{
		if (isset($_REQUEST['csrf_token'])) {
			$this->CSRFCheckGenerate();
			if ($this->isCSRFSameReferer() && hash_equals($this->token, $_REQUEST['csrf_token'])) {
				if ((time() - $_SESSION['csrf_expire_check'] < self::TokenExpiry) && $this->isCSRFTokenRecent()) {
					unset($_SESSION['csrf_token']);
					return;
                }
				die(LANG['csrf-expired']);
				return;			
            }
			die(LANG['csrf-rejected']);
			return;
        }
		die(LANG['csrf-forgotten']);
	}
    
}