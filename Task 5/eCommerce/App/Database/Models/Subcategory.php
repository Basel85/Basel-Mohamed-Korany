<?php
  namespace App\Database\Models;

use App\Database\Models\Contracts\Crud;

  class Subcategory extends Model implements Crud{
    private $id,$name_en,$name_ar,$status,$image,$category_id,$created_at,$updated_at;
    const TABLE = "subcategories";

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName_en()
    {
        return $this->name_en;
    }

    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getName_ar()
    {
        return $this->name_ar;
    }

    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }
 
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory_id()
    {
        return $this->category_id;
    }

    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function create()
    {
        #####
    }
    public function read()
    {
       ####
    }
    public function update()
    {
        #####
    }
    public function delete()
    {
        #####
    }
    public function getSubcatbyCat(){
        $query = "SELECT name_en , id FROM ".self::TABLE." WHERE category_id = ? And status = 1 ";
        $stmt = $this->getConn()->prepare($query);
        if(! $stmt){
            return false;
        }
        $bind = $stmt->bind_param("i",$this->category_id);
        if(! $bind){
            return false;
        }
        $stmt->execute();
        return $stmt->get_result();
    }
  } 
?>