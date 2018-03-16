<?php

class Model{
protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = [];
public $id;


//$table = 'user_sessions' DATENBANK TABELLE wird zu 'UserSession' Model

  public function __construct($table){

      $this->_db = DB::getInstance();
      $this->_table = $table;
      $this->_setTableColumns();
      $this->_modelName = str_replace(' ', '', ucwords(str_replace('_',' ', $this->_table)));

  }

  //Hier werden die Properties  für die Model Class erstellt.
  //Mit get_columns() werden die Spalten geholt Woher kommt Field ?????

  protected function _setTableColumns(){
      $columns = $this->get_columns();
      foreach($columns as $column){
        $columnName = $column->Field;
        $this->_columnNames[] = $column->Field;
        $this->{$columnName} = null;

      }
  }

  public function get_columns(){
      return $this->_db->get_columns($this->_table);
    }



  public function find($params = []){
          $results = [];
          $resultsQuery = $this->_db->find($this->_table, $params);
          foreach($resultsQuery as $result){
          $obj = new $this->_modelName($this->_table);
          $obj->populateObjData($result);
          $results[] = $obj;
        }
      return $results;
    }


    public function findFirst($params = []){
      $resultQuery = $this->_db->findFirst($this->_table, $params);
      $result = new $this->_modelName($this->_table);
      if($resultQuery){
      $result->populateObjData($resultQuery);
      }
      return $result;
    }

    public function findById($id){
      return $this->findFirst(['conditions' => "id = ?", 'bind' => [$id]]);
    }

    public function save(){
        $fields = [];
        foreach($this->_columnNames as $column){
          $fields[$column] = $this->$column;
        }
        //determine whether to update or INSERT
        if(property_exists($this, 'id') && $this->id !=''){
          return $this->update($this->id, $fields);
        }else{
          return $this->insert($fields);
        }
    }

    public function insert($fields){
      if(empty($fields)) return false;
      return $this->_db->insert($this->_table, $fields);
    }

    public function update($id, $fields){
      if(empty($fields) || $id == '') return false;
      return $this->_db->update($this->_table, $id,  $fields);

    }

    public function delete($id = ''){
        if($id =='' && $this->id == '') return false;
        $id =($id == '') ? $this->id : $id;
        if($this->_softDelete){
          return $this->update($id, ['deleted' => 1]);
        }
      return $this->_db->delete($this->_table, $id);
    }


    public function query($sql, $bind=[]){

      return $this->_db->query($sql, $bind);
    }


    protected function populateObjData($result){
      foreach($result as $key => $val){
        $this->$key = $val;
      }
    }

    public function data(){
      $data = new StdClass();
      foreach($this->columnNames as $column) {
        $data->column = $this->column;
      }
      return $data;
    }

    public function assign($params){
      if(!empty($params)){
        foreach($params as $key => $val){
          if(in_array($key, $this->_columnNames)){
            $this->$key = sanitize($val);
          }
        }
        return true;
      }
      return false;
    }





}
