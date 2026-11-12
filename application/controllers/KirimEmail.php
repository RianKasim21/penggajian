<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class KirimEmail extends CI_Controller {

 public function __construct()
 {
   parent::__construct(); 

   require APPPATH.'libraries/phpmailer/src/Exception.php';
   require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
   require APPPATH.'libraries/phpmailer/src/SMTP.php';
 }

 public function index()
 {
   $this->load->view('formemail');
 }

 public function send()
 {
   // PHPMailer object
   $response = false;
   $mail = new PHPMailer();
  
   // SMTP configuration
   $mail->isSMTP();
   $mail->Host     = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'riankasim421@gmail.com'; // user email anda
   $mail->Password = 'dwdjgxxwfcqghown'; // diisi dengan App Password yang sudah di generate
   $mail->SMTPSecure = 'ssl';
   $mail->Port     = 465;
  
   $mail->setFrom('riankasim421@gmail.com', 'Pt. WASWESWOS'); // user email anda
   $mail->addReplyTo('riankasim421@gmail.com', ''); //user email anda
  
   // Email subject
   $mail->Subject = 'Gaji Bulan Ini'; //subject email
  
   // Add a recipient
   $mail->addAddress($this->input->post('email')); //email tujuan pengiriman email
  
   // Set email format to HTML
   $mail->isHTML(true);
  
   // Email body content
   $mailContent = "<p>Hallo <b>".$this->input->post('nama_guru')."</b> berikut ini adalah Gaji Anda:</p>
   <table>
     <tr>
       <td>Nama</td>
       <td>:</td>
       <td>".$this->input->post('nama_guru')."</td>
     </tr>
     <tr>
       <td>Jabatan</td>
       <td>:</td>
       <td>".$this->input->post('nama_jabatan')."</td>
     </tr>
     <tr>
       <td>Email</td>
       <td>:</td>
       <td>".$this->input->post('email')."</td>
     </tr>
     <tr>
       <td>Gaji</td>
       <td>:</td>
       <td>".$this->input->post('gaji')."</td>
     </tr>
   </table>
   <p>Terimakasih <b>".$this->input->post('nama')."</b> telah memberi komentar.</p>"; // isi email
   $mail->Body = $mailContent;
  
   // Send email
   if(!$mail->send()){
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
   }else{
     echo 'Message has been sent';
   }
 }
}