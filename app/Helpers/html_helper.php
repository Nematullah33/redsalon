<?php
 
 function select_field($config){
  
   $config["value"]=isset($config["value"])?$config["value"]:""; 
   $id=isset($config["value_column"])?$config["value_column"]:"id";  
   $name=isset($config["display_column"])?$config["display_column"]:"name";  

   $ucname=ucfirst($config["name"]);
   
   
   $html="<div class='form-group row'>";
   $html.="<label class='col-sm-2 col-form-label'>{$config["label"]}</label>";
   $html.="<div class='col-sm-10'>"; 
   $html.="<select name='{$config["name"]}' id='{$config["name"]}' class='form-control'>";
    
   foreach($config["table"] as $row){
      if($config["value"]==$row->id){
         $html.="<option value='$row->id' selected>$row->name</option>";
      }else{
         $html.="<option value='$row->id'>$row->name</option>";
      }      
   }
   $html.="</select>";
   $html.="</div>";
   $html.="</div>";
 
   return $html;
 
 }

 function input_field($config){

    $config["required"]=isset($config["required"])?$config["required"]:"";
    $config["placeholder"]=isset($config["placeholder"])?$config["placeholder"]:"";
    $config["value"]=isset($config["value"])?$config["value"]:"";     
    $config["type"]=isset($config["type"])?$config["type"]:"text"; 
    $config["checked"]=isset($config["checked"])?$config["checked"]:""; 

    $html="<div class='form-group row'>";

     if($config["type"]!="hidden"){
      $html.="<label for='{$config["name"]}' class='col-sm-2 col-form-label'>{$config["label"]}</label>";
     }

    $html.="<div class='col-sm-10'>";
    $html.="<input type='{$config["type"]}' class='form-control' name='{$config["name"]}' id='{$config["name"]}' value='{$config["value"]}' placeholder='{$config["placeholder"]}' {$config["required"]} {$config["checked"]}>";
    $html.="</div>";
    $html.="</div>";  

    return $html;

 }

 function input_button($config){
    $html="<input type='{$config["type"]}' value='{$config["value"]}' name='{$config["name"]}' class='btn btn-info' />";
    return $html;
 }
?>