<?php

namespace src\models;

use \core\Model;

class User extends Model
{
  private $id;
  private $name;
  private $email;
  private $token;
  private $avatar;
  private $birthdate;
  private $age;
  private $cover;
  private $city;
  private $work;
  private $followers;
  private $following;
  private $photos;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = strtolower($email);
  }

  public function getToken()
  {
    return $this->token;
  }

  public function setToken($token)
  {
    $this->token = $token;
  }

  public function getAvatar()
  {
    return $this->avatar;
  }

  public function setAvatar($avatar)
  {
    $this->avatar = $avatar;
  }

  public function getBirthdate()
  {
    return $this->birthdate;
  }

  public function setBirthdate($birthdate)
  {
    $this->birthdate = $birthdate;
  }

  public function getCover()
  {
    return $this->cover;
  }

  public function setCover($cover)
  {
    $this->cover = $cover;
  }

  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;
  }

  public function getWork()
  {
    return $this->work;
  }

  public function setWork($work)
  {
    $this->work = $work;
  }

  public function getFollowers()
  {
    return $this->followers;
  }

  public function setFollowers($followers)
  {
    $this->followers = $followers;
  }

  public function getFollowing()
  {
    return $this->following;
  }

  public function setFollowing($following)
  {
    $this->following = $following;
  }

  public function getPhotos()
  {
    return $this->photos;
  }

  public function setPhotos($photos)
  {
    $this->photos = $photos;
  }

  public function getAge()
  {
    return $this->age;
  }

  public function setAge($age)
  {
    $this->age = $age;
  }
}
