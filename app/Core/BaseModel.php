<?php
namespace Com\Daw2\Core;

abstract class BaseModel
{
   protected $db;

   public function __construct()
   {
      $this->db = DBManager::getInstance()->getConnection();
   }
}