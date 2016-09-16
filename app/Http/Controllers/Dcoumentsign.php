<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Dcoumentsign extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
	
    public function baseurl(){
		$templateId = "1a518d2a-a3bb-4066-9cc2-724f9ac5d68b";
		$envelopeId = "1a518d2a-a3bb-4066-9cc2-724f9ac5d68b";
		$userId = "d78c6531-c3bd-46ce-ae9a-0b896d668e06";
		$folderId = "b4a0aa43-5cc6-4d16-bd1e-6ba269a2a4d4";
		
		
		$envelope = \Docusign::getEnvelope($envelopeId);
		$envelopeId = $envelope['envelopeId'];
		$envRecipients = \Docusign::getEnvelopeRecipients($envelopeId, true);

echo '<pre>'; print_r($envRecipients); die;		
		
$users = \Docusign::createRecipientView($envelopeId, array(
    'userName' => 'amir hanga',
    'email' => 'amirh@chetu.com',
    'AuthenticationMethod' => 'email',
    'clientUserId' => "d78c6531-c3bd-46ce-ae9a-0b896d668e06", // Must create envelope with this ID
    'returnUrl' => 'http://azmensclinic.chetu.com/'
));	



/* 		\Docusign::createEnvelope(array(
		   'templateId'     => '1a518d2a-a3bb-4066-9cc2-724f9ac5d68b', // Template ID
		   'emailSubject'   => 'Demo Envelope Subject', // Subject of email sent to all recipients
		   'status'         => 'created', // created = draft ('sent' will send the envelope!)
		   'templateRoles'  => array(
				['name'     => 'ash',
				 'email'    => 'amirh@chetu.com',
				 'roleName' => 'Contractor',
				 'clientUserId'  => 1],
				['name'     => 'avp',
				 'email'    => 'amirprimetime@gmail.com',
				 'roleName' => 'Customer']),
		));		 */
		
		
		
	}
}
