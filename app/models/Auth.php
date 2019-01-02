<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Auth extends Model
{
    private $db;
    protected $_codeLength = 6;

    public function __construct()
    {
       $this->db = new Model();
    }
    
    public function dologin($username, $password) // Check login credentials are correct
    {
        $bind = [':username' => $username];
        $results = $this->db->select('everything_users', 'username = :username', $bind);
        $hashed_password = $results[0]['password'];
        if (password_verify($password, $hashed_password)) {
            return $results;
        }
        return false;
    }
    
    public function doRegister($data) // Insert new account
    {
        $date = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        $insert = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'pin' => $data['pin'],
            'country' => $data['country'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'avatar' => $data['avatar'],
            'extra_security' => $data['extra_security'],
            'extra_security_code' => $data['extra_security_code'],
            'created' => $date,
            'last_activity' => $date,
            'last_ip' => $ip,
            'verify_code' => $data['verify_code'],
            'status' => $data['status'],
        ];
        $this->db->insert('everything_users', $insert);
        $this->insertRegisterSettings($data);
        return true;
    }
    
    public function insertRegisterSettings($data) // Insert new account settings
    {
        $insert = [
            'user_pin' => $data['pin'],
        ];
        $this->db->insert('everything_users_settings', $insert);
        return true;
    }

    public function checkUsername($username) // Check if username already exists
    {
        $bind = [':username' => $username];
        $results = $this->db->select('everything_users', 'username = :username', $bind);
        return $results;
    }
    
    public function checkEmail($email) // Check if email already exists
    {
        $bind = [':email' => $email];
        $results = $this->db->select('everything_users', 'email = :email', $bind);
        return $results;
    }
    
    public function checkActive($username) // Check if user activated
    {
        $bind = [':username' => $username];
        $results = $this->db->select('everything_users', 'status = 1 AND username = :username', $bind);
        return $results;
    }
    
    public function checkBan($username) // Check if user banned
    {
        $bind = [':username' => $username];
        $results = $this->db->select('everything_users', 'status = 2 AND username = :username', $bind);
        return $results;
    }
    
    public function getUserByUserPin($pin) // Get user by pin
    {
        $bind = [':pin' => $pin];
        $results = $this->db->select('everything_users', 'pin = :pin', $bind);
        return $results;
    }
    
    public function getUserByUserPinLimited($pin) // Get limited user data
    {
        $bind = [':pin' => $pin];
        $sql = 'SELECT id, pin, email, username, last_activity, status, avatar FROM everything_users WHERE status = 1 AND pin = :pin';
        $results = $this->db->selectExtended($sql, $bind);
        return $results;
    }
    
    public function updateUserSecurity($data) // Update account status to verified
    {
        $bind = [
            ':pin' => $data['pin'],
        ];
        $update = [
            'extra_security' => $data['extra_security'],
        ];
        $this->db->update('everything_users', $update, 'pin = :pin', $bind);
        return true;
    }
    
    // 2 Step Auth

    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();
        unset($validChars[32]);

        $secret = '';
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $validChars[array_rand($validChars)];
        }
        return $secret;
    }
    
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }

        $secretkey = $this->_base32Decode($secret);

        // Pack time into binary string
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);

        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;

        $modulo = pow(10, $this->_codeLength);
        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }
    
    public function getQRCodeGoogleUrl($name, $secret, $title = null) 
    {
        $urlencoded = urlencode('otpauth://totp/'.$name.'?secret='.$secret.'');
        if (isset($title)) {
            $urlencoded .= urlencode('&issuer='.urlencode($title));
        }
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }
    
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }

        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($calculatedCode == $code ) {
                return true;
            }
        }

        return false;
    }
    
    public function setCodeLength($length)
    {
        $this->_codeLength = $length;
        return $this;
    }
    
    protected function _base32Decode($secret)
    {
        if (empty($secret)) return '';

        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);

        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) return false;
        for ($i = 0; $i < 4; $i++){
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) return false;
        }
        $secret = str_replace('=','', $secret);
        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i = $i+8) {
            $x = "";
            if (!in_array($secret[$i], $base32chars)) return false;
            for ($j = 0; $j < 8; $j++) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); $z++) {
                $binaryString .= ( ($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48 ) ? $y:"";
            }
        }
        return $binaryString;
    }
    
    protected function _base32Encode($secret, $padding = true)
    {
        if (empty($secret)) return '';

        $base32chars = $this->_getBase32LookupTable();

        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i++) {
            $binaryString .= str_pad(base_convert(ord($secret[$i]), 10, 2), 8, '0', STR_PAD_LEFT);
        }
        $fiveBitBinaryArray = str_split($binaryString, 5);
        $base32 = "";
        $i = 0;
        while ($i < count($fiveBitBinaryArray)) {
            $base32 .= $base32chars[base_convert(str_pad($fiveBitBinaryArray[$i], 5, '0'), 2, 10)];
            $i++;
        }
        if ($padding && ($x = strlen($binaryString) % 40) != 0) {
            if ($x == 8) $base32 .= str_repeat($base32chars[32], 6);
            elseif ($x == 16) $base32 .= str_repeat($base32chars[32], 4);
            elseif ($x == 24) $base32 .= str_repeat($base32chars[32], 3);
            elseif ($x == 32) $base32 .= $base32chars[32];
        }
        return $base32;
    }
    
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '='  // padding char
        );
    }

}