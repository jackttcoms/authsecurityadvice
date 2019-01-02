<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

class Extras extends Model
{
    private $db;

    public function __construct()
    {
        $this->db = new Model();
    }
    
    public function getEmailTemplates($limit = '') // Get all email templates
    {
        $results = $this->db->select('everything_email_templates', 'status >= 0 ORDER BY id DESC ' . $limit);
        return $results;
    }
    
    public function countEmailTemplates() // Get all email templates
    {
        $results = $this->db->select('everything_email_templates', 'status >= 0 ORDER BY id DESC');
        if (!empty($results)) {
            $totalRows = count($results);
        }
        if ($results === FALSE) { $totalRows = 0; }
        return $totalRows;
    }
    
    public function updateEmailTemplate($data) // Update email template
    {
        $bind = [
            ':id' => $data['formData']['id']
        ];
        $update = [
            'subject' => $data['formData']['subject'],
            'template' => $data['formData']['content'],
            'notes' => $data['formData']['notes'],
        ];
        $this->db->update('everything_email_templates', $update, 'id = :id', $bind);
        return true;
    }
    
}