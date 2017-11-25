<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


  public function __construct()
  {
    parent::__construct();
  }

  public function getUser()
  {
    return $this->db->query("SELECT * FROM users");
  }


public function Login()
{
	if(isset($_POST['login']))
	{
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{

			$username = $_POST['username'];
			$password = sha1($_POST['password']);

      $data = $this->db->query("SELECT * FROM users WHERE username = :username AND password = :pass);
      $data->execute(array(
        ':username' => $username,
        ':pass' => $password
      ));



			if($data->fetchColumn() == 1)
			{
        $data = $this->db->query('UPDATE users SET last_login = :last_login WEHRE username = :username');
        $data->execute(array(
  					':last_login' => time(),
  					':username'   => $username
        ));

				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;

				LogData('Login UserCP', 'Logged into UserCP');

				echo '<div class="callout success">Success, logging in..</div>';
				echo '<script>
							setTimeout(function () {
							   window.location.href = "usercp.php";
							}, 3000);
						</script>';
			}
			else
			{
				echo '<div class="callout alert">Wrong username or password!</div>';
			}
		}
		else
		{
			echo '<div class="callout alert">Please fill in all fields!</div>';
		}
	}
}



public function isLoggedOut()
{
	if(!isset($_SESSION['username']))
	{
		if(!isset($_SESSION['password']))
		{
			header('Location: login.php');
			exit();
		}

		header('Location: login.php');
		exit();
	}
}

public function isLoggedIn()
{
	if(isset($_SESSION['username']))
	{
		if(isset($_SESSION['password']))
		{
			header('Location: usercp.php');
			exit();
		}

		header('Location: usercp.php');
		exit();
	}
}



};
