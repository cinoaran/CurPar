<?php

class Tools extends Controller{

  public function __construct($controller, $action){

      parent::__construct($controller, $action);
      // Its also set as default here for furter Layout changes
      $this->view->setLayout('default');
    }
  public function indexAction(){

    $this->view->render('tools/index');

  }

  public function firstAction(){

    $this->view->render('tools/first');

  }

  public function secondAction(){

    $this->view->render('tools/second');

  }

  public function thirdAction(){

    $this->view->render('tools/third');

  }


}
