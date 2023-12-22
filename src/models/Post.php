<?php

namespace src\models;

use \core\Model;

class Post extends Model
{
  private $id;
  private $type;
  private $userId;
  private $body;
  private $createdAt;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = trim($id);
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType($type)
  {
    $this->type = trim($type);
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = trim($userId);
  }

  public function getBody()
  {
    return $this->body;
  }

  public function setBody($body)
  {
    $this->body = trim($body);
  }

  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    $this->createdAt = trim($createdAt);
  }
}
