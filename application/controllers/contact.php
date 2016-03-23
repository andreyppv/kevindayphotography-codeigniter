<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends Base_Controller {

    protected $page_title2 = 'Contact';
    protected $menu = 'contact';
        
        
    public function index()
    {               
        if($this->input->post('btn-submit'))
        {
            $email      = $this->input->post('email');
            $first_name =  $this->input->post('first_name');
            $last_name  =  $this->input->post('last_name');
            $phone      =  $this->input->post('phone');
            $text       =  $this->input->post('textarea_input');
            
            $to = 'kevin@kevindayphotography.com';
            $subject = 'Request From Kevin Conatct Us Form';

            $radios = $this->input->post('radios');
            if ($radios == 'option1') {
                $prefered = 'E-mail';
            }
            if ($radios == 'option2') {
                $prefered = 'Phone';
            }
            if ($radios == 'option3') {
                $prefered = 'Sms';
            }
            
            $message = "
            <table>
                <tr><td>First Name: {$first_name}</td></tr>
                <tr><td>Last Name: {$last_name}</td></tr>
                <tr><td>Email Address: {$email}</td></tr>
                <tr><td>Phone Number: {$phone}</td></tr>
                <tr><td>Message: {$text}</td></tr>
                <tr><td>Preferred Contact Method: {$prefered}</td></tr>
            </table>";
            
            //load emailer
            $this->load->library('emailer');
            
            //send data
            $data = array(
                'to'         => 'kevin@kevindayphotography.com',
                'subject'    => $subject,
                'message'    => $message
            );
            
            if($this->emailer->send($data))
            {
                Template::set_message('Email Send Successfully', 'success');
                
                //sent email to contacter again
                $data['to'] = $email;
                $data['subject'] = 'Received your contact request';
                $this->emailer->send($data);
            }
            else
            {
                Template::set_message('Some Error Occur, Try again later', 'danger');
            }
            
            
            redirect($this->uri->uri_string());
        }
        
        $this->render();
    }
}