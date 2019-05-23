<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	include_once ($filepath.'/../phpmailer/PHPMailer.php');
	include_once ($filepath.'/../phpmailer/class.smtp.php');

	class User
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function userRegistration($name,$username,$password,$cnfpassword,$email)
		{
			$name 		= $this->fm->validation($name);
			$username 	= $this->fm->validation($username);
			$password 	= $this->fm->validation($password);
			$cnfpassword 	= $this->fm->validation($cnfpassword);
			$email 		= $this->fm->validation($email);
			
			$name 		= mysqli_real_escape_string($this->db->link,$name);
			$username 	= mysqli_real_escape_string($this->db->link,$username);
			$password 	= mysqli_real_escape_string($this->db->link,$password);
			$cnfpassword 	= mysqli_real_escape_string($this->db->link,$cnfpassword);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			
			if($name == "" || $username == "" || $password == "" || $cnfpassword == "" || $email == "" )
			{
				echo "<span class='error'>Field must not be empty!</span>";
				exit();
			}
			else
			{
				if (!preg_match("/^[a-zA-Z ]*$/",$name))
				{
					echo "Only letters and white space allowed";
					exit();

				}

				if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0)
				{
					echo '<p class="error">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
					exit();
				}
				if($password != $cnfpassword)
				{
					echo '<p class="error">pleace enter same password</p>';
					exit();
				}
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					echo '<p class="error">Invalid email address</p>';
					exit();
				}
				
				$chkquery = "SELECT * FROM tbl_user WHERE email='$email'";
				$chkresult = $this->db->select($chkquery);
				if($chkresult != false)
				{
					echo "<span class='error'>Email already exit!</span>";
					exit();
				}
				else
				{
					$query = "INSERT INTO tbl_user(name,username,password,email) VALUES('$name','$username','$password','$email')";
					$insert_row = $this->db->insert($query);
					if($insert_row)
					{
						echo "<span class='success'>Registration Successfully</span>";
						exit();
					}
					else
					{
						echo "<span class='error'>Error try again!</span>";
						exit();
					}
				}
			}

		}

		public function userLogin($email,$password)
		{
			$email 		= $this->fm->validation($email);
			$password 	= $this->fm->validation($password);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			$password 	= mysqli_real_escape_string($this->db->link,$password);
			
			if($email == "" || $password == "")
			{
				echo "empty";
				exit();
			}
			else
			{
				$query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if($result != false)
				{
					$value = $result->fetch_assoc();
					if($value['status'] == '1')
					{
						echo "disable";
						exit();
					}
					else
					{
						Session::init();
						Session::set("userLogin",true);
						Session::set("userid",$value['userId']);
						Session::set("username",$value['username']);
						Session::set("name",$value['name']);
					}
				}
				else
				{
					echo "error";
					exit();
				}
			}
		}

		public function updateUserData($userid,$data)
		{
			$name 		= $this->fm->validation($data['name']);
			$username 	= $this->fm->validation($data['username']);
			$email 		= $this->fm->validation($data['email']);
			$name 		= mysqli_real_escape_string($this->db->link,$name);
			$username 	= mysqli_real_escape_string($this->db->link,$username);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			
			$query = "UPDATE tbl_user
						SET 
						name = '$name',
						username = '$username',
						email = '$email'
						WHERE userId = '$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row)
			{
				$msg = "<span class ='success'>User Updated !</span>";
				return $msg;
			}
			else
			{
				$msg = "<span class ='error'>User Not Updated !</span>";
				return $msg;
			}
		}
		

		public function getUserData($userid)
		{
			$query = "SELECT * FROM tbl_user WHERE userId ='$userid'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllUser()
		{
			$query = "select * from tbl_user ORDER BY userId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function DisableUser($userid)
		{
			$query = "UPDATE tbl_user
						SET 
						status = '1'
						WHERE userId = '$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row)
			{
				$msg = "<span class ='success'>User Disabled !</span>";
				return $msg;
			}
			else
			{
				$msg = "<span class ='error'>User Not Disabled !</span>";
				return $msg;
			}
		}

		public function EnableUser($userid)
		{
			$query = "UPDATE tbl_user
						SET 
						status = '0'
						WHERE userId = '$userid'";
			$updated_row = $this->db->update($query);
			if($updated_row)
			{
				$msg = "<span class ='success'>User Enable !</span>";
				return $msg;
			}
			else
			{
				$msg = "<span class ='error'>User Not Enable !</span>";
				return $msg;
			}
		}

		public function DeleteUser($userid)
		{
			$query = "DELETE FROM tbl_user WHERE userId = '$userid'";
			$deldata = $this->db->delete($query);
			if($deldata)
			{
				$msg = "<span class ='success'>User Removed !</span>";
				return $msg;
			}
			else
			{
				$msg = "<span class ='error'>Error User Not Removed !</span>";
				return $msg;
			}
		}

		public function forgotPassword($data)
		{
			$email 		= $this->fm->validation($data['email']);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			
			if($email == "")
			{
				$msg = "<span class ='error'> Please enter a valid Email Id</span>";
				return $msg;
			}
			else
			{
				$query = "SELECT * FROM tbl_user WHERE email='$email'";
				$result = $this->db->select($query);
				if($result == false)
				{
					$msg = "<span class ='error'> Invalid Email Id</span>";
					return $msg;
				}
				else
				{
						$value = $result->fetch_assoc();
						require_once("phpmailer/PHPMailer.php");
    					require_once("phpmailer/class.smtp.php");					
    					$mail = new PHPMailer();
						$mail->IsSMTP();
						$mail->SMTPDebug = 0;                                     // set mailer to use SMTP
						$mail->Host = "smtp.gmail.com";  // specify main and backup server
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = "tls";
						$mail->Port     = 587;     // turn on SMTP authentication
						$mail->Username = "gdas64682@gmail.com";  // SMTP username
						$mail->Password = "Gopaldas5#"; // SMTP password

						$mail->AddReplyTo("gdas64682@gmail.com", "Information");
						$mail->SetFrom("gdas64682@gmail.com", "Online Exam System");
						$mail->AddReplyTo("gdas64682@gmail.com", "Information");
						

						$mail->WordWrap = 50;                                 // set word wrap to 50 characters
						$mail->IsHTML(true);
						$address = $email;
						$message = "For the Security of your property , do not disclose your verification code to others";
						$name = $value['name'];
						$mail->addAddress($address);                               // set email format to HTML
						
						$mail->Subject = "Your forgot password";
						$mail->Body    = "<tr>
											<td><h3 style='color:Chartreuse'>".$name."</h3>Your password is <strong>".$value['password']."</strong></td>
										</tr>
										<tr>
											<td style='color:Crimson'>". $message." </td>
										</tr>";
						$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

						if(!$mail->Send())
						{
						   $msg = "<span class ='error'> please enter correct </span>".$mail->ErrorInfo;
						   return $msg;
						}
						else
						{

						   $msg = "<span class ='success'> Message has been sent</span>";
						   return $msg;
						}

				}
								
							
			}
		}

		public function changePassword($userid,$data)
		{
			$password 	= $this->fm->validation($data['password']);
			$cnfpassword 	= $this->fm->validation($data['cnfpassword']);

			$password 	= mysqli_real_escape_string($this->db->link,$password);
			$cnfpassword 	= mysqli_real_escape_string($this->db->link,$cnfpassword);

			if($password == "" || $cnfpassword == "")
			{
				$msg = "<span class='error'>Field must not be empty!</span>";
				return $msg;
			}
			if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0)
			{
				$msg = '<p class="error">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
				return $msg;
			}
			if($password != $cnfpassword)
			{
				$msg = '<p class="error">pleace enter same password</p>';
				return $msg;
			}
			else
			{
				$query = "UPDATE tbl_user
						SET 
						password = '$password'
						WHERE userId = '$userid'";
				$updated_row = $this->db->update($query);
				if($updated_row)
				{
					$msg = "<span class='success'>Password Change Successfully</span>";
					return $msg;
				}
				else
				{
					$msg = "<span class='error'>Error try again!</span>";
					return $msg;
				}
			}
		}
	}


?>