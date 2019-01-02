<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Home extends Controller
{
    public function __construct()
    {
        $this->load_helper(['view', 'start', 'date', 'email']);
        $this->session = $this->model('Session');
        $this->csrf = $this->model('Csrf');
    }

    public function index()
    {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') // check submitted via post
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // clean post
            $this->csrf->CSRFTokenVerify(); // check csrf token
            
            $formData = [
                'email' => trim($_POST['email']),
                'email_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'title' => 'everything project homepage',
                'description' => '',
            ];

            if (empty($data['formData']['email'])) { // check email not empty
                $data['formData']['email_err'] = LANG['auth-register-invalid8'];
            } elseif (!filter_var($data['formData']['email'], FILTER_VALIDATE_EMAIL)) { // check valid email
				$data['formData']['email_err'] = LANG['auth-register-invalid9'];
            }
            
            if (empty($data['formData']['email_err']) && empty($data['formData']['global_err'])) {
                    if (emailHelp::smtpMail($data['formData']['email'], 'Verify Account Test Email', '<h1>Hi, [USER_NAME]</h1>
<p><br />Verify your account <a href="[VERIFY_URL]">Click here to verify!</a></p>')) {
                        startHelp::flash('message', 'mail sent', 'alert alert-success rounded-0 mb-0', 'data-auto-dismiss="10000"');
                        startHelp::redirect('');
                    } else {
                        die(LANG['something-went-wrong']);
                    }
            } else {
                $this->view('home', $data);
            }
        } else {
            $formData = [
                'email' => '',
                'email_err' => '',
            ];
            $data = [
                'formData' => $formData,
                'title' => 'everything project homepage',
                'description' => '',
            ];

            $this->view('home', $data);   
        }
    }
    
    public function error()
    {
        $data = [
            'title' => 'error 404',
            'description' => '',
        ];
        
        $this->view('common/error', $data);
    }

    public function phpinfo()
    {
        echo phpinfo();
    }

}