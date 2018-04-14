<?php
namespace App;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/04/2018
 * Time: 06:56
 */
class Validator
{
    private $data;

    protected $errors = [];

    public function __construct(array $data = []){
        $this->data = $data;
    }
    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        $this->errors = [];
        $this->data = $data;
        return $this->errors;
    }

    public function validate(string $field, string $method, ...$parameters){
        if(!isset($this->data[$field])){
            $this->errors[$field] = "Le champ $field n'est pas rempli";
        }else{
            call_user_func([$this, $method], $field, ...$parameters);
        }
    }

    public function minLenght(string $field, int $lenght) : bool{
        if(mb_strlen($field) < $lenght){
            $this->errors[$field] = "Le champ doit avoir plus de $lenght caractère";
            return false;
        }
        return true;
    }

    public function date(string $field) : bool{
        if(\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
            $this->errors[$field] = "Ce format de date est incorecte";
            return false;
        }
        return true;
    }

    public function time(string $field) : bool{
        if(\DateTime::createFromFormat('H:i', $this->data[$field]) === false){
            $this->errors[$field] = "Ce format de date est incorecte";
            return false;
        }
        return true;
    }

    public function beforeTime(string $startField, string $endField) : bool{
        if($this->time($startField) && $this->time($endField)){
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if($start->getTimestamp() > $end->getTimestamp()){
                $this->errors[$startField] = "Le temps $startField ne doit pas êtres inferieur au de fin";
                return false;
            }
            return true;
        }
        return false;
    }
}