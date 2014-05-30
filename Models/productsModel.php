<?php

class productsModel
{
  public function getProducts($productsParams)
  {
    if($productsParams['user_id'] && $productsParams['product_id'])
    {
        $sql = "select * from user_products where user_id=:user_id and product_id=:product_id";
    }
    else
    {
        $sql = "select * from user_products where user_id=:user_id";
    }
    $db = new Database();
    $statement = $db->prepare($sql);
    foreach($productsParams as $key=>$value)
    {

        $statement->bindValue("$key",$value);
    }
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteProducts($productsParams)
  {
    if($productsParams['user_id'] && $productsParams['product_id'])
    {
        $sql = "delete from user_products where user_id=:user_id and product_id=:product_id";
    }
    else
    {
        $sql = "delete from user_products where user_id=:user_id";
    }
    $db = new Database();
    $statement = $db->prepare($sql);
    foreach($productsParams as $key=>$value)
    {

        $statement->bindValue("$key",$value);
    }
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
  }


  function insertProducts($productsParams)
  {
    $data = $productsParams['products'];
    $fieldNames = implode('`, `', array_keys($data));
    $fieldValues = ':' . implode(', :', array_keys($data));
    $db = new Database();
    $statement = $db->prepare("INSERT INTO user_products (`$fieldNames`,user_id) VALUES ($fieldValues,:user_id)");
    foreach ($data as $key => $value)
    {
        $statement->bindValue(":$key", $value);
    }
    $statement->bindValue(":user_id",$productsParams['user_id']);
    $statement->execute();
    return $db->lastInsertId();
  }

  function updateProducts($productsParams)
  {
    $data = $productsParams['products'];
    $fieldDetails = NULL;
    foreach($data as $key=> $value) {
        $fieldDetails .= "`$key`=:$key,";
    }
    $db = new Database();
    $fieldDetails = rtrim($fieldDetails, ',');
    $statement = $db->prepare("UPDATE user_products SET $fieldDetails WHERE user_id=:user_id and product_id=:product_id");
    foreach ($data as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->bindValue(":user_id",$productsParams['user_id']);
    $statement->bindValue(":product_id",$productsParams['product_id']);
    $statement->execute();
    $count = $statement->rowCount();
    return $count;
  }
}