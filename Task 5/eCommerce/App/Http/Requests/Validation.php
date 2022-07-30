<?php
namespace App\Http\Requests;
use App\Database\Models\Model;
class Validation
{
    private $key;
    private $value;
    private $FieldsErrors = [];
    public function IsEmpty()
    {
        if (empty($this->value)) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "{$this->key} is required";
        }
        return $this;
    }
    public function IsString()
    {
        if (!is_string($this->value)) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "You must enter text";
        }
        return $this;
    }
    public function maxLengthChecker(int $max)
    {
        if (strlen($this->value) > $max) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "You must enter a value less than or equal to {$max} characters";
        }
        return $this;
    }
    public function minLengthChecker(int $min)
    {
        if (strlen($this->value) < $min) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "You must enter a value greater than or equal to {$min} characters";
        }
        return $this;
    }
    public function IsConfirmed($ComparedValue)
    {
        if ($this->value != $ComparedValue) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "Repeat the {$this->key} correctly";
        }
        return $this;
    }
    public function patternChecker($pattern, $message = null)
    {
        if (!preg_match($pattern, $this->value)) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = $message ?? "The {$this->key} is invalid";
        }
        return $this;
    }
    public function isInside(array $arr)
    {
        if (!in_array($this->value, $arr)) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "The value of {$this->key} must be one of these values" . implode($arr);
        }
        return $this;
    }

    public function IsUnique(string $tableName, string $columnName)
    {
        $model = new Model;
        $stmt = $model->getConn()->prepare("SELECT * FROM {$tableName} WHERE {$columnName} = ?");
        $stmt->bind_param("s", $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "This {$this->key} already exists";
        }
        return $this;
    }

    public function IsExists(string $tableName, string $columnName){
        $model = new Model;
        $stmt = $model->getConn()->prepare("SELECT * FROM {$tableName} WHERE {$columnName} = ?");
        $stmt->bind_param("s", $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            $this->FieldsErrors[$this->key][__FUNCTION__] = "This {$this->key} does not exist";
        }
        return $this;
    }
    
    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getFieldsErrors()
    {
        return $this->FieldsErrors;
    }

    public function setFieldsErrors($FieldsErrors)
    {
        $this->FieldsErrors = $FieldsErrors;

        return $this;
    }

    public function getErrorMsg(string $error)
    {
        if (isset($this->FieldsErrors[$error])) {
            foreach ($this->FieldsErrors[$error] as $errorValue) {
                return "<p class = 'text-danger'>{$errorValue}</p>";
            }
        }
        return "";
    }
}
