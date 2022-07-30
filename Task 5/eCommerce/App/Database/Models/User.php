<?php

namespace App\Database\Models;

use App\Database\Models\Contracts\Crud;

class User extends Model implements Crud
{
    private $id, $first_name, $last_name, $email, $phone, $password,
        $gender, $status, $birthday, $verification_code, $email_verified_at, $created_at, $updated_at;
    const TABLE = "users";

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

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

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getVerification_code()
    {
        return $this->verification_code;
    }

    public function setVerification_code($verification_code)
    {
        $this->verification_code = $verification_code;

        return $this;
    }

    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    public function setEmail_verified_at($email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;

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

    public function checkCode(){
        $query = "SELECT * FROM " . self::TABLE . " WHERE email = ? AND verification_code = ?";
        $stmt = $this->conn->prepare($query);
        if(! $stmt){
            return false;
        }
        $stmt->bind_param("si", $this->email, $this->verification_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function emailVerification(){
        $query  = "UPDATE ". self::TABLE . " SET `email_verified_at` = ? WHERE email = ?"; 
        $stmt = $this->conn->prepare($query);
        if (! $stmt) {
            return false;
        }
        $stmt->bind_param("ss", $this->email_verified_at, $this->email);
        return $stmt->execute();
    }

    public function getUserbyEmail(){
        $query = "SELECT * FROM " . self::TABLE . " WHERE email = ? ";
        $stmt = $this->conn->prepare($query);
        if(! $stmt){
            return false;
        } 
        $stmt->bind_param('s',$this->email);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function changePassword(){
        $query = "UPDATE ". self::TABLE . " SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        if(! $stmt){
            return false;
        }
        $bind = $stmt->bind_param("ss",$this->password,$this->email);
        if(! $bind){
            return false;
        }
        return $stmt->execute();
    }

    public function create()
    {
        $query = "INSERT INTO " . self::TABLE . "(first_name , last_name , email , phone , password , gender , verification_code) 
        VALUES (? , ? , ? , ? , ? , ? , ?)";
        $stmt = $this->conn->prepare($query);
        if (! $stmt) {
            return false;
        }
        $bind  = $stmt->bind_param("ssssssi", $this->first_name, $this->last_name, $this->email, $this->phone, $this->password, $this->gender, $this->verification_code);
        if(! $bind){
            return false;
        }
        return $stmt->execute();
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
