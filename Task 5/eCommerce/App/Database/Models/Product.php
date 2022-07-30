<?php

namespace App\Database\Models;

use App\Database\Models\Contracts\Crud;

class Product extends Model implements Crud
{
   private $id, $name_en, $name_ar, $price, $quantity, $code, $status, $image,
      $details_en, $details_ar, $subcategory_id, $brand_id, $created_at, $updated_at;
   const TABLE = "products";
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

   public function getPrice()
   {
      return $this->price;
   }

   public function setPrice($price)
   {
      $this->price = $price;

      return $this;
   }

   public function getQuantity()
   {
      return $this->quantity;
   }

   public function setQuantity($quantity)
   {
      $this->quantity = $quantity;

      return $this;
   }

   public function getCode()
   {
      return $this->code;
   }

   public function setCode($code)
   {
      $this->code = $code;

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

   public function getDetails_en()
   {
      return $this->details_en;
   }

   public function setDetails_en($details_en)
   {
      $this->details_en = $details_en;

      return $this;
   }

   public function getDetails_ar()
   {
      return $this->details_ar;
   }

   public function setDetails_ar($details_ar)
   {
      $this->details_ar = $details_ar;

      return $this;
   }

   public function getSubcategory_id()
   {
      return $this->subcategory_id;
   }

   public function setSubcategory_id($subcategory_id)
   {
      $this->subcategory_id = $subcategory_id;

      return $this;
   }

   public function getBrand_id()
   {
      return $this->brand_id;
   }

   public function setBrand_id($brand_id)
   {
      $this->brand_id = $brand_id;

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

   public function getNewProducts(int $number_of_products)
   {
      $query = "SELECT id,name_en,price,`image`,`status` FROM " . self::TABLE . " group by ".self::TABLE. ".`id`
      HAVING ".self::TABLE.".`status` = 1 ORDER BY created_at DESC LIMIT {$number_of_products}";
      $model = new Model;
      $stmt = $model->getConn()->prepare($query);
      if (!$stmt) {
         return false;
      }
      $stmt->execute();
      return $stmt->get_result();
   }
   public function getMostOrderedProducts(int $number_of_products)
   {
      $query = "SELECT id, name_en , `image` , `status` , ". self::TABLE .".`price` ,COUNT(`order_product`.`order_id`) FROM " 
      . self::TABLE ." LEFT JOIN `order_product`
      ON " . self::TABLE . ".id=`order_product`.`product_id`
      group by " . self::TABLE . ".`id` HAVING ".self::TABLE.".`status` = 1 
      ORDER BY COUNT(`order_product`.`order_id`) DESC LIMIT {$number_of_products}";
      $model = new Model;
      $stmt = $model->getConn()->prepare($query);
      if (!$stmt) {
         return false;
      }
      $stmt->execute();
      return $stmt->get_result();
   }
   public function create()
   {
      #####
   }
   public function read()
   {
      #####
   }
   public function update()
   {
      #####
   }
   public function delete()
   {
      #####
   }
}
