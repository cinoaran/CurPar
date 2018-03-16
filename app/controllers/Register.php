<?php
class Register extends Controller{

  public function __construct($controller, $action){
    parent::__construct($controller, $action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function loginAction(){
    $validation = new Validate();
    if($_POST){
      //FORM VALIDATION check() FROM Validate.php. Nicht eingebaut 'min' => 9 'max'=12
      $validation->check($_POST, [
            'username' => [
              'display'=>"Username",
              'required'=> true
            ],
            'password' => [
              'display'=>"Password",
              'required'=> true,
              'min' => 3
            ]
          ]);
          //FORM VALIDATION passed() FROM Validate.php
          if($validation->passed()){

            $user = $this->UsersModel->findByUsername($_POST['username']);

            if($user && password_verify(Input::get('password'), $user->password)){
              $rememberMe = (isset($_POST["remember_me"]) && Input::get('remember_me')) ? true : false;
              $user->login($rememberMe);
              Router::redirect('');
            }else{
              // Alles ist leer.
              $validation->addError("There is an error with your username or password.");
            }

          }

        }

  // <div class="bg-danger"><?=$this->displayErrors ........ in login.php befüllen
   $this->view->displayErrors = $validation->displayErrors();
   //Passwort cino erzeugen und ablesen um ein password für username cinoaran zu erstellen.
    //echo password_hash("cino", PASSWORD_DEFAULT);
    $this->view->render('register/login');
  }

  public function logoutAction(){
  //  dnd(currentUser());
    //function currentUser() comes from helpers.php
    if(currentUser()){
    currentUser()->logout();
    }
    Router::redirect('register/login');
  }

  public function registerAction() {
    $validation = new Validate;
    $posted_values = ['fname'=> '', 'lname'=>'', 'email' =>'', 'username'=>'', 'password'=>'', 'confirm'=>''];
    if($_POST){
      $posted_values = posted_values($_POST);
      $validation->check($_POST, [
        'fname'=> [
          'display' => 'First Name',
          'required' => true
        ],
        'lname'=> [
          'display' => 'Last Name',
          'required' => true
        ],
        'email'=> [
          'display' => 'Email',
          'required' => true,
          'unique' => 'users',
          'max' => 150,
          'valid_email' => true
        ],
        'username'=> [
          'display' => 'Username',
          'required' => true,
          'unique' => 'users',
          'min' => 6,
          'max' => 150
        ],
        'password'=> [
          'display' => 'Password',
          'required' => true,
          'min' => 6
        ],
        'confirm'=> [
          'display' => 'Confirmed-Password',
          'required' => true,
          'matches' => 'password'
        ]
      ]);

      if($validation->passed()){
        $newUser = new Users();
        $newUser->registerNewUser($_POST);
        //$newUser->login();
        Router::redirect('register/login');
      }
    }

    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/register');
  }


}
