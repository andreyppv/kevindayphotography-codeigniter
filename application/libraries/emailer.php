<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Emailer
{
    /**
     * Whether to send emails immediately or queue them by default.
     *
     * If TRUE, will queue emails into the database to be sent later.
     * If FALSE, will send the email immediately.
     *
     * @access public
     *
     * @var bool
     */
    public $queue_emails = FALSE;


    /**
     * An array of errors generated during the course of the script running.
     *
     * @access public
     *
     * @var array
     */
    public $errors = array();


    /**
     * A private variable for reporting extra information about the
     * running of the script and the sending of immediate emails.
     *
     * @access private
     *
     * @var bool
     */
    private $debug = FALSE;

    /**
     * A pointer to the CodeIgniter instance.
     *
     * @access private
     *
     * @var object
     */
    private $ci;

    //--------------------------------------------------------------------

    /**
     * Sets up the CodeIgniter core object
     *
     * @return void
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    //--------------------------------------------------------------------

    /**
     * Handles sending the emails and routing to the appropriate methods
     * for queueing or sending.
     *
     * Information about the email should be sent in the $data
     * array. It looks like:
     *
     * $data = array(
     *     'to' => '',    // either string or array
     *     'subject' => '',    // string
     *     'message' => '',    // string
     *     'alt_message' => ''    // optional (text alt to html email)
     * );
     *
     * @access public
     *
     * @param array $data           An array of required information need to send the email.
     * @param bool  $queue_override (optional) Overrides the value of $queue_emails.
     *
     * @return bool TRUE/FALSE    Whether the operation was successful or not.
     */
    public function send($data=array(), $queue_override=null, $time='')
    {
        // Make sure we have the information we need.
        $to = isset($data['to']) ? $data['to'] : FALSE;
        $from = settings_item('site.system_email');
        $subject = isset($data['subject']) ? $data['subject'] : FALSE;
        $message = isset($data['message']) ? $data['message'] : FALSE;
        $alt_message = isset($data['alt_message']) ? $data['alt_message'] : FALSE;

        // If we don't have everything, return FALSE.
        if ($to == FALSE || $subject == FALSE || $message == FALSE)
        {
            $this->errors[] = lang('em_missing_data');
            return FALSE;
        }

        // Wrap the $message in the email template.
        $mailtype = settings_item('mailtype');
        $templated = '';
        if ($mailtype == 'html')
        {
            $templated  = $this->ci->load->view('_emails/_header', null, TRUE);
            $templated .= $message;
            $templated .= $this->ci->load->view('_emails/_footer', null, TRUE);
        }

        // Should we put it in the queue?
        if ($queue_override === TRUE || ($queue_override !== FALSE && $this->queue_emails == TRUE))
        {
            return $this->queue_email($to, $from, $subject, $templated, $alt_message, $time);
        }
        // Otherwise, we're sending it right now.
        else
        {
            return $this->send_email($to, $from, $subject, $templated, $alt_message);
        }

    }//end send()

    //--------------------------------------------------------------------

    /**
     * Add the email to the database to be sent out during a cron job.
     *
     * @access private
     *
     * @param string $to          The email to send the message to
     * @param string $from        The from email (Ignored in this method, but kept for consistency with the send_email method.
     * @param string $subject     The subject line of the email
     * @param string $message     The text to be inserted into the template for HTML emails.
     * @param string $alt_message An optional, text-only version of the message to be sent with HTML emails.
     *
     * @return bool TRUE/FALSE    Whether it was successful or not.
     */
    private function queue_email($to=null, $from=null, $subject=null, $message=null, $alt_message=FALSE, $time='')
    {
        $this->ci->db->set('to_email', $to);
        $this->ci->db->set('subject', $subject);
        $this->ci->db->set('message', $message);
        
        //added
        $this->ci->db->set('identity', $time);

        if ($alt_message)
        {
            $this->ci->db->set('alt_message', $alt_message);
        }

        $result['success'] = $this->ci->db->insert('email_queue');

        if ($this->debug)
        {
            $result['debug'] = lang('em_no_debug');
        }

        return $result;

    }//end queue_email

    //--------------------------------------------------------------------

    /**
     * Sends the email immediately.
     *
     * @access private
     *
     * @param string $to          The email to send the message to
     * @param string $from        The from email.
     * @param string $subject     The subject line of the email
     * @param string $message     The text to be inserted into the template for HTML emails.
     * @param string $alt_message An optional, text-only version of the message to be sent with HTML emails.
     *
     * @return bool TRUE/FALSE    Whether it was successful or not.
     */
    private function send_email($to=null, $from=null, $subject=null, $message=null, $alt_message=FALSE)
    {
        $this->ci->load->library('email');
        $this->ci->load->model('setting_model');
        $this->ci->email->initialize($this->ci->setting_model->select('name,value')->find_all_by('module', 'email'));

        $this->ci->email->set_newline("\r\n");
        $this->ci->email->to($to);
        $this->ci->email->from($from, settings_item('site.title'));
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);

        if ($alt_message)
        {
            $this->ci->email->set_alt_message($alt_message);
        }

        if ((defined('ENVIRONMENT') && ENVIRONMENT == 'development') && $this->ci->config->item('emailer.write_to_file') === TRUE) {
            if (!function_exists('write_file')) {
                $this->ci->load->helper('file');
            }
            write_file($this->ci->config->item('log_path').str_replace(" ","_",strtolower($subject)).substr(md5($to.time()),0,8).".html",$message);
            $result['success'] = TRUE;
        }
        else
        {
            $result['success'] = $this->ci->email->send();
        }

        if ($this->debug)
        {
            $result['debug'] = $this->ci->email->print_debugger();
        }

        return $result;

    }//end send_email()

    //--------------------------------------------------------------------

    /**
     * Process the email queue in chunks.
     *
     * Defaults to 33 which, if processed every 5 minutes, equals 400/hour
     * And should keep you safe with most ISP's. Always check your ISP's
     * terms of service to verify, though.
     *
     * @access public
     *
     * @param int $limit An int specifying how many emails to process at once.
     *
     * @return bool TRUE/FALSE    Whether the method was successful or not.
     */
    public function process_queue($limit=33)
    {
        //$limit = 33; // 33 emails every 5 minutes = 400 emails/hour.
        $this->ci->load->library('email');

        $config_settings = $this->ci->setting_model->select('name,value')->find_all_by('module', 'email');

        // Grab records where success = 0
        $this->ci->db->limit($limit);
        $this->ci->db->where('success', 0);
        $query = $this->ci->db->get('email_queue');

        if ($query->num_rows() > 0)
        {
            $emails = $query->result();
        }
        else
        {
            return TRUE;
        }

        foreach($emails as $email)
        {
            echo '.';

            $this->ci->email->clear();
            $this->ci->email->initialize($config_settings);

            $this->ci->email->from(settings_item('site.system_email'), settings_item('site.title'));
            $this->ci->email->to($email->to_email);

            $this->ci->email->subject($email->subject);
            $this->ci->email->message($email->message);
            $this->ci->email->set_newline("\r\n");

            if ($email->alt_message)
            {
                $this->ci->email->set_alt_message($email->alt_message);
            }

            $prefix = $this->ci->db->dbprefix;

            if ($this->ci->email->send() === TRUE)
            {
                // Email was successfully sent
                $sql = "UPDATE {$prefix}email_queue SET success=1, attempts=attempts+1, last_attempt = NOW(), date_sent = NOW() WHERE id = " .$email->id;
                $this->ci->db->query($sql);
            }
            else
            {
                // Error sending email
                $sql = "UPDATE {$prefix}email_queue SET attempts = attempts+1, last_attempt=NOW() WHERE id=". $email->id;
                $this->ci->db->query($sql);

                if (class_exists('CI_Session'))
                {
                    $result = $this->ci->email->print_debugger();
                    $this->ci->session->set_userdata('email_debug', $result);
                }

            }
        }//end foreach

        return TRUE;

    }//end process_queue()
    
    //--------------------------------------------------------------------

    /**
     * Tells the emailer lib to show or hide the debugger string.
     *
     * @access public
     *
     * @param bool $show_debug TRUE/FALSE - enable/disable debugging messages
     */
    public function enable_debug($show_debug)
    {
        $this->debug = $show_debug;

    }//end enable_debug()

    //--------------------------------------------------------------------

    /**
     * Specifies whether to queue emails in the send() method.
     *
     * @param bool $queue Queue emails instead of sending them directly.
     *
     * @return void
     */
    public function queue_emails($queue)
    {
        if ($queue !== TRUE && $queue !== FALSE)
        {
            return;
        }

        $this->queue_emails = $queue;

    }//end queue_emails()

    //--------------------------------------------------------------------

    public function process_queue_time($time)
    {
        $this->ci->load->library('email');

        $config_settings = $this->ci->setting_model->select('name,value')->find_all_by('module', 'email');

        // Grab records where success = 0
        $this->ci->db->where('success', 0);
        $query = $this->ci->db
            ->where('identity', $time)
            ->get('email_queue');

        if ($query->num_rows() > 0)
        {
            $emails = $query->result();
        }
        else
        {
            return TRUE;
        }

        $row_ids = array();
        foreach($emails as $email)
        {
            //echo '.';
            $row_ids[] = $email->id;

            $this->ci->email->clear();
            $this->ci->email->initialize($config_settings);

            $this->ci->email->from(settings_item('site.system_email'), settings_item('site.title'));
            $this->ci->email->to($email->to_email);

            $this->ci->email->subject($email->subject);
            $this->ci->email->message($email->message);
            $this->ci->email->set_newline("\r\n");

            if ($email->alt_message)
            {
                $this->ci->email->set_alt_message($email->alt_message);
            }

            $prefix = $this->ci->db->dbprefix;

            $this->ci->email->send();
        }//end foreach
        
        //delete sent
        $this->ci->db->where('identity', $time)->delete('email_queue');

        return TRUE;

    }//end process_queue()
    
    public function process_queue2($limit=33)
    {
        //$limit = 33; // 33 emails every 5 minutes = 400 emails/hour.
        $this->ci->load->library('email');

        $config_settings = $this->ci->setting_model->select('name,value')->find_all_by('module', 'email');

        // Grab records where success = 0
        $this->ci->db->limit($limit);
        $this->ci->db->where('success', 0);
        $query = $this->ci->db->get('email_queue');

        if ($query->num_rows() > 0)
        {
            $emails = $query->result();
        }
        else
        {
            return TRUE;
        }

        if(!empty($emails))
        {
            $success_emails = array();
            foreach($emails as $email)
            {
                echo '.';

                $this->ci->email->clear();
                $this->ci->email->initialize($config_settings);

                $this->ci->email->from(settings_item('site.system_email'), settings_item('site.title'));
                $this->ci->email->to($email->to_email);

                $this->ci->email->subject($email->subject);
                $this->ci->email->message($email->message);
                $this->ci->email->set_newline("\r\n");

                if ($email->alt_message)
                {
                    $this->ci->email->set_alt_message($email->alt_message);
                }

                $prefix = $this->ci->db->dbprefix;

                if ($this->ci->email->send() === TRUE)
                {
                    $success_emails[] = $email->id;
                }
            }//end foreach
            
            //delete success emails
            $this->ci->db->where_in('id', $success_emails)->delete('email_queue');
        }
        
        return TRUE;

    }//end process_queue()
}//end class

/* End of file emailer.php */
/* Location: ./application/core_modules/emailer/libraries/emailer.php */