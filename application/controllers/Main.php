<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
	public function index()
	{
		$this->login();
	}
	public function login(){

		$this->load->view('login');
	}
	public function signup(){
		$this->load->view('signup');
	}
	
	public function members(){
if($this->session->userdata('is_logged_in'))
		$this->load->view('members');
	else
		redirect('main/restricted');
	}
public function restricted(){
$this->load->view('restricted');
}

	public function login_validation(){
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password','required|md5|trim');
		
		if($this->form_validation->run())
		{
			$data=array(
			'email'=>$this->input->post('email'),
			'is_logged_in'=>1
			);
			
			$this->session->set_userdata($data);
			redirect('main/members');	
		}
		else{
			$this->load->view('login');
		}
	/*	echo $_POST['email'];
		echo $this->input->post('email');*/
		
		
	}
	
	public function signup_validation(){
		$this->load->model('model_users');
		$this->load->helper('email');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
		$this->form_validation->set_message('is_unique','bu email adresi veritabanında mevcuttur!');

		if($this->form_validation->run())
		{
			echo "oldu";
			$key=md5(uniqid());
			
			include 'PHPMailer.php';
			$mail = new PHPMailer();
			$mail->SMTPAuth = true;
			$mail->IsSMTP();
			$mail->Host = 'smtp.yandex.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->Username = 'eliteboymusti@yandex.com';
			$mail->Password = '6&Yozgat';
			$mail->SetFrom($mail->Username, "registration confirm");
			$mail->AddAddress($_POST["email"], 'mkostek');
			$mail->CharSet = 'UTF-8';
			$mail->Subject = "aktivasyon lütfen";
			//$message="";
			$message="<p>Tebrikler <a href='".base_url()."main/register_user/$key'>tıhla</a>buradan üyeliğinizi onaylayınız...</p>";
			$mail->MsgHTML($message);
			if($this->model_users->add_temp_users($key))
			{
			if($mail->Send())
			{
			echo ' Mail gönderildi!';
			} else {echo "olmadı ";
			echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
			$this->load->view('signup');
			}
			}else{
				echo "veritabanı eklenme hatası";
			}
			
			
			
			
		/*	$this->load->library('email',array('mailtype'=>'html'));
			$this->email->from('eliteboymusti@yandex.com',"mkostek");
			$this->email->to("mustafakostek@gmail.com");
			$this->email->subject("uyelginizi onaylayınız!");
			
			$message="<p>Uye oldugunuz için teşekkür ederiz</p>";
			$message.="<p><a href='".base_url()."main/register_user/$key'>tıhla</a>buradan üyelşğinizi onaylayınız...</p>";
			$this->email->message($message);
			if($this->email->send())
				echo "email gonderildi";
			else echo "email gönderilemedi";
			}
			else
			{
				
				$this->load->view('signup');
			}*/
				
	
	
	
	}else $this->load->view('signup');
}
	
	public function validate_credentials(){
		$this->load->model('model_users');
		if($this->model_users->can_log_in())
		{
			return true;
		}
			
		else{
			$this->form_validation->set_message('validate_credentials','geçersiz parola yada kullanıcı  adı');
			return false;
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('main/login');
	}
	public function register_user($key)
	{
		$this->load->model('model_users');
		if($this->model_users->is_valid_key($key))
			//echo "valid key";
		if($newmail=$this->model_users->add_user($key))
		{
			
			$data=array(
			'email' => $newmail,
			'is_logged_in'=>1
			);
			$this->session->set_userdata($data);
			redirect('main/members');
		}
		
		else
			echo "Başarısız kayıt lütfen tekrar deneyin";
	}
}
