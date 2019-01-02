<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class User extends Controller
{
    public function __construct()
    {
        $this->load_helper(['view', 'start', 'date', 'email', 'pagination', 'upload', 'geoip', 'recaptcha']);
        $this->session = $this->model('Session');
        $this->start = $this->model('Start');
        $this->auth = $this->model('Auth');
        $this->csrf = $this->model('Csrf');
    }

    public function index()
    {
        startHelp::redirect('error');
    }

    public function register()
    {
        if (startHelp::isSessionValid() && $_SESSION['uaccess'] == 1) { // if already logged in, redirect
            startHelp::redirect('');
            exit(0);
        } elseif (startHelp::isSessionValid() && $_SESSION['uaccess'] == 0) { // if part logged in, redirect
            startHelp::redirect('user/login2');
            exit(0);            
        }
        
        $getSettings = $this->start->getSettings(); // load site settings db data
        $recaptcha = new Recaptcha('register', $getSettings[0]['global_recaptchasite'], $getSettings[0]['global_recaptchasecret']); // load recaptcha class for spam protection
        
        $getCountries = $this->start->getCountries(); // get all countries
        $getPopularCountries = $this->start->getCountries('TRUE'); // get popular countries
        $geoplugin = new geoPlugin(); // load the location plugin
        
        $always = [ // data that is constantly needed for this page
            'getSettings' => $getSettings,
            'helpRecaptcha' => $recaptcha,
            'getCountries' => $getCountries,
            'getPopularCountries' => $getPopularCountries,
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') // check submitted via post
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // clean post
            $this->csrf->CSRFTokenVerify(); // check csrf token
            
            $formData = [
                'fname' => ucfirst(trim($_POST['fname'])),
                'lname' => ucfirst(trim($_POST['lname'])),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'country' => trim($_POST['country']),
                'country-name' => $this->start->getCountryName($_POST['country']),
                
                'pin' => rand(1000, 9999) . rand(10, 99) . time(),
                'avatar' => '',
                'status' => '0',
                'extra_security' => '0',
                'extra_security_code' => $this->auth->createSecret(),
                'verify_code' => startHelp::generateCryptoRandomString('32'),
                
                'fname_err' => '',
                'lname_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'country_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'always' => $always,
                'title' => LANG['auth-register-title'],
                'description' => '',
            ];

            if (empty($data['formData']['fname'])) { // check fname not empty
                $data['formData']['fname_err'] = LANG['auth-register-invalid1'];
            } elseif (strlen($data['formData']['fname']) < 2) { // check fname longer than 2
                $data['formData']['fname_err'] = LANG['auth-register-invalid2'];
            }
            if (empty($data['formData']['lname'])) { // check lname not empty
                $data['formData']['lname_err'] = LANG['auth-register-invalid3'];
            } elseif (strlen($data['formData']['lname']) < 2) { // check lname longer than 2
                $data['formData']['lname_err'] = LANG['auth-register-invalid4'];
            }
            if (empty($data['formData']['username'])) { // check username not empty
                $data['formData']['username_err'] = LANG['auth-register-invalid5'];
            } elseif (!preg_match('/^[A-Za-z0-9_]+$/', $data['formData']['username'])) { // check username contains only letters, numbers & underscores
                $data['formData']['username_err'] = LANG['auth-register-invalid6'];
            } elseif ($this->auth->checkUsername($data['formData']['username'])) { // check username not already in use
                $data['formData']['username_err'] = LANG['auth-register-invalid7'];
            }
            if (empty($data['formData']['email'])) { // check email not empty
                $data['formData']['email_err'] = LANG['auth-register-invalid8'];
            } elseif (!filter_var($data['formData']['email'], FILTER_VALIDATE_EMAIL)) { // check valid email
				$data['formData']['email_err'] = LANG['auth-register-invalid9'];
            } elseif ($this->auth->checkEmail($data['formData']['email'])) { // check email not already in use
                $data['formData']['email_err'] = LANG['auth-register-invalid10'];
            }
            if (empty($data['formData']['password'])) { // check password not empty
                $data['formData']['password_err'] = LANG['auth-register-invalid11'];
            } elseif (strlen($data['formData']['password']) < 8) { // check password longer than 8
                $data['formData']['password_err'] = LANG['auth-register-invalid12'];
            } elseif (!preg_match( '/[a-z]/', $data['formData']['password'])) { // check password contains lowercase letters
		        $data['formData']['password_err'] = LANG['auth-register-invalid12'];
	        } elseif (!preg_match( '/[A-Z]/', $data['formData']['password'])) { // check password contains uppercase letters
	            $data['formData']['password_err'] = LANG['auth-register-invalid12'];
	        } elseif (!preg_match( '/[0-9]/', $data['formData']['password'])) { // check password contains numbers
	            $data['formData']['password_err'] = LANG['auth-register-invalid12'];
	        }
            if (empty($data['formData']['confirm_password'])) { // check confirm password not empty
                $data['formData']['confirm_password_err'] = LANG['auth-register-invalid13'];
            } elseif ($data['formData']['password'] != $data['formData']['confirm_password']) { // check password + confirm password match
                $data['formData']['confirm_password_err'] = LANG['auth-register-invalid14'];
            }
            $country_code = array_column($always['getCountries'], 'country_code'); // get all countries
            if (empty($data['formData']['country'])) { // check country not empty
                $data['formData']['country_err'] = LANG['auth-register-invalid15'];
            } elseif (!in_array($data['formData']['country'], $country_code)) { // check valid country
                $data['formData']['country_err'] = LANG['auth-register-invalid16'];
            } elseif (!empty($geoplugin->countryCode) && $data['formData']['country'] != $geoplugin->countryCode) { // if geoplugin working check location matches ip
                $data['formData']['country_err'] = LANG['auth-register-invalid17'];
            }
            if ($getSettings[0]['global_recaptchaon'] == '1' && !$recaptcha->success()) { // if recaptcha on, check success
                $data['formData']['global_err'] = LANG['auth-register-invalid18'];
            }
            
            if (empty($data['formData']['fname_err']) && empty($data['formData']['lname_err']) && empty($data['formData']['username_err']) && empty($data['formData']['email_err']) && empty($data['formData']['password_err']) && empty($data['formData']['confirm_password_err']) && empty($data['formData']['country_err']) && empty($data['formData']['global_err'])) {
                $formData['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);
                if ($this->auth->doRegister($formData)) {
                    $emailData = $this->start->getEmailData('2');
                    $token = [
                        'SITE_URL' => FULL_ROOT,
                        'SITE_NAME' => $getSettings[0]['global_company'],
                        'USER_NAME' => $data['formData']['username'],
                        'USER_EMAIL' => $data['formData']['email'],
                        'VERIFY_URL' => FULL_ROOT . '/user/verify/' . $data['formData']['email'] . '/' . $data['formData']['verify_code'],
				    ];
                    $emailContent = emailHelp::mailTemplateData($token, $emailData);
                    if (emailHelp::smtpMail($data['formData']['email'], $emailData[0]['subject'], $emailContent)) {
                        startHelp::flash('message', LANG['auth-register-success'], 'alert alert-success rounded-0 mb-0', 'data-auto-dismiss="10000"');
                        startHelp::redirect('');
                    } else {
                        die(LANG['something-went-wrong']);
                    }
                } else {
                    die(LANG['something-went-wrong']);
				}
            } else {
                $this->view('user/register', $data);
            }
        } else {
            $formData = [
                'fname' => '',
                'lname' => '',
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'country' => (empty($geoplugin->countryCode) ? '' : $geoplugin->countryCode),
                'country-name' => (empty($geoplugin->countryName) ? '' : $geoplugin->countryName),
                
                'fname_err' => '',
                'lname_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'country_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'always' => $always,
                'title' => LANG['auth-register-title'],
                'description' => '',
            ];

            $this->view('user/register', $data);   
        }
    }
    
    public function login()
    {
        if (startHelp::isSessionValid() && $_SESSION['uaccess'] == 1) { 
            startHelp::redirect('');
            exit(0);
        } elseif (startHelp::isSessionValid() && $_SESSION['uaccess'] == 0) {
            startHelp::redirect('user/login2');
            exit(0);            
        }
        
        $getSettings = $this->start->getSettings();
        
        $always = [
            'getSettings' => $getSettings,
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->csrf->CSRFTokenVerify();
            
            $formData = [
                'username' => trim($_POST['username']),
                'password' => $_POST['password'],
                
                'username_err' => '',
                'password_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'always' => $always,
                'title' => LANG['auth-login-title'],
                'description' => '',
            ];
            
            if (empty($data['formData']['username'])) {
                $data['formData']['username_err'] = LANG['auth-login-invalid1'];
            }
            if (empty($data['formData']['password'])) {
                $data['formData']['password_err'] = LANG['auth-login-invalid3'];
            }
            
            if (empty($data['formData']['username_err']) && empty($data['formData']['password_err']) && empty($data['formData']['global_err'])) {
                $userAuthenticated = $this->auth->doLogin($data['formData']['username'], $data['formData']['password']);
                if ($userAuthenticated && $this->auth->checkActive($data['formData']['username'])) { // if login correct and user active
                    
                    // here eventually do the thottling switch case after 3 incorrect lock out for 10 mins and then after 5 for 15 mins then lock account for admin/staff to reactivate
                    switch ($userAuthenticated[0]['extra_security']) {
                        case 1:
                            $this->createInitial2Step($userAuthenticated);
                            break;
                        default:
                            $this->createUserSession($userAuthenticated);
                    }
        
                } elseif ($userAuthenticated && $this->auth->checkBan($data['formData']['username'])) { // if user banned
                    $data['formData']['global_err'] = 'user banned';
                    $data['formData']['password'] = '';
                    $this->view('user/login', $data);                   
				} elseif ($userAuthenticated && !$this->auth->checkActive($data['formData']['username'])) { // If user not active lock
                    $data['formData']['global_err'] = 'user not active';
                    $data['formData']['password'] = '';
                    $this->view('user/login', $data);
                } else { // If user credentials incorrect then
                    $formData = [
                        'username' => trim($_POST['username']),
                        'password' => '',
                        'username_err' => LANG['auth-login-invalid2'],
                        'password_err' => LANG['auth-login-invalid4'],
                        'global_err' => '',
				    ];
                    $data = [
                        'formData' => $formData,
                        'always' => $always,
                        'title' => LANG['auth-login-title'],
                        'description' => '',
				    ];
                        		
                    $this->view('user/login', $data);
				}
            } else {
                $this->view('user/login', $data);
            }
        } else {
            $formData = [
                'username' => '',
                'password' => '',
                
                'username_err' => '',
                'password_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'always' => $always,
                'title' => LANG['auth-login-title'],
                'description' => '',
            ];

            $this->view('user/login', $data);   
        }
    }
    
    public function login2()
    {
        if (startHelp::isSessionValid() && $_SESSION['uaccess'] == 1) { 
            startHelp::redirect('');
            exit(0);
        } elseif (!startHelp::isSessionValid()) {
            startHelp::redirect('user/login');
            exit(0);            
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->csrf->CSRFTokenVerify();
            
            $formData = [
                'username' => $_SESSION['uname'],
                'code' => trim($_POST['code']),
                'code_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'title' => '',
                'description' => '',
            ];
            
            $string = preg_replace('/\s+/', '', $data['formData']['code']); // ignore any spaces in string
            
            if (empty($data['formData']['code'])) { // code not empty
                $data['formData']['code_err'] = 'code empty';
            }
            
            if (empty($data['formData']['code_err']) && empty($data['formData']['global_err'])) {
                $verifyCode = $this->auth->verifyCode($_SESSION['authCode'], $string, 2);    // 2 = 2*30sec clock tolerance
                
                if ($verifyCode) {      
                    $finalUserData = $this->auth->getUserByUserPinLimited($_SESSION['upin']);
                    $this->complete2StepLogin($finalUserData);
                } else {
                    $formData = [
                        'username' => $_SESSION['uname'],
                        'code_err' => 'invalid code',
                        'global_err' => '',
				    ];
                    $data = [
                        'formData' => $formData,
                        'title' => 'login to account',
                        'description' => '',
				    ];
                        		
                    $this->view('user/login2', $data);
                }

            } else {
                $this->view('user/login2', $data);
            }
            
        } else {
            $formData = [
                'username' => $_SESSION['uname'],
                'code' => '',
                
                'username_err' => '',
                'code_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'title' => 'enter code to complete login',
                'description' => '',
            ];

            $this->view('user/login2', $data);   
        }
    }
    
    public function settings()
    {
        $getSettings = $this->start->getSettings();
        $getUserData = $this->auth->getUserByUserPin($_SESSION['upin']);
        
        $always = [
            'getSettings' => $getSettings,
            'getUserData' => $getUserData,
        ];
        
        $qrCodeUrl = $this->auth->getQRCodeGoogleUrl($getUserData[0]['email'], $getUserData[0]['extra_security_code'], $getSettings[0]['global_company']);
       // $seccode = $this->auth->getCode($getUserData[0]['extra_security_code']);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            
            $formData = [
                'extra_security' => (isset($_POST['2sa'])) ? 1 : 0,
                'pin' => $_SESSION['upin'],
                'global_err' => '',
            ];   
            
            if($this->auth->updateUserSecurity($formData)) {
                startHelp::flash('message', '2 step status changed', 'alert alert-success mb-0');
                startHelp::redirect('user/settings');
            } else {
                die(LANG['something-went-wrong']);
            }
        } else {
            $data = [
                'always' => $always,
                'qrcode' => $qrCodeUrl,
                
                'title' => 'enter code to complete login',
                'description' => '',
            ];
        
            $this->view('user/settings', $data);    
        }
    }
 
    
    private function createUserSession($user) // no two step auth
    {
        $_SESSION['uid'] = $user[0]['id'];
        $_SESSION['upin'] = $user[0]['pin'];
        $_SESSION['uemail'] = $user[0]['email'];
        $_SESSION['uname'] = $user[0]['username'];
        $_SESSION['uaccess'] = ($user[0]['extra_security'] == 0 ? '1' : '0');
        $_SESSION['authCode'] = $user[0]['extra_security_code'];
        startHelp::flash('message', 'success login', 'alert alert-success mb-0', 'data-auto-dismiss="10000"');
        startHelp::redirect('');
        exit(0);
    }
    
    private function createInitial2Step($user)
    {
        $_SESSION['upin'] = $user[0]['pin'];
        $_SESSION['uname'] = $user[0]['username'];
        $_SESSION['uaccess'] = ($user[0]['extra_security'] == 0 ? '1' : '0');
        $_SESSION['authCode'] = $user[0]['extra_security_code'];
        startHelp::redirect('user/login2');
        exit(0);
    }
    
    private function complete2StepLogin($user)
    {
        $_SESSION['uid'] = $user[0]['id'];
        $_SESSION['upin'] = $user[0]['pin'];
        $_SESSION['uemail'] = $user[0]['email'];
        $_SESSION['uname'] = $user[0]['username'];
        $_SESSION['uaccess'] = 1;
        unset($_SESSION['authCode']);
        startHelp::flash('message', '2 step success login', 'alert alert-success mb-0', 'data-auto-dismiss="10000"');
        startHelp::redirect('');
        exit(0);
    }
    
    public function logout()
    {
        if (!startHelp::isSessionValid()) { startHelp::redirect(''); exit(0); }
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            unset($_SESSION['uid']);
            unset($_SESSION['upin']);
            unset($_SESSION['uemail']);
            unset($_SESSION['uname']);
            unset($_SESSION['uaccess']);
            session_destroy();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            startHelp::flash('message', 'logout success', 'alert alert-success mb-0', 'data-auto-dismiss="10000"');
            startHelp::redirect('');
            exit(0);
        } else {
            startHelp::flash('message', 'logout failed', 'alert alert-danger mb-0');
            startHelp::redirect('');
            exit(0);
        }
    }
    
}