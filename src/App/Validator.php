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


    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        $this->errors = [];
        $this->data = $data;
    }

    public function validate(string $field, string $method, ...$parameters){
        if(!isset($this->data[$field])){
            $this->errors[$field] = "Le champ $field n'est pas rempli";
        }else{
            call_user_func([$this, $method], $field, ...$parameters);
        }
    }

    public function minLenght(string $field, int $lenght){
        if(mb_strlen($field) < $lenght){
            $this->errors[$field] = "Le champ doit avoir plus de $lenght caractère";
        }
    }
}