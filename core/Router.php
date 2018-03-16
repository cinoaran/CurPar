<?php
class Router{

  public static function route($url){

    //Extract url for controller parameter etc... from urlencode and take care of DEFAULT_CONTROLLER...../
    $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
    $controller_name = $controller;
    array_shift($url);

    //Extract url for Action ......indexAction, registerAction to work with inside the controller class.
    $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'IndexAction';
    $action_name = $controller;
    array_shift($url);

    // Take the rest of the $url as Params
    $queryParams = $url;
    // Extract params from url and instaziate object from the Controller
    $dispatch = new $controller ($controller_name, $action);
    if(method_exists($controller, $action)){
      // Something like call_user_func_array([Object, Method registerAction], 558);
      // $dispatch->registerAction($queryParams) will be instead
      call_user_func_array([$dispatch, $action], $queryParams);
    }else{
      die('That method does not exists in the controller \"' .$controller.'\'"');
    }

  }

  public static function redirect($location) {
    if(!headers_sent()){
      header('Location: '.PROOT.$location);
      exit();
    }else{
      echo '<script type="text/javascript">';
      echo 'window.location.href="'.PROOT.$location.'";';
      echo '</script>';
      echo '<noscript>';
      echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
      echo '</noscript>'; exit();

      }
  }


}
