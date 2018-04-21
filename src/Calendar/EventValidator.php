<?php
namespace Calendar;
use App\Validator;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/04/2018
 * Time: 06:52
 *
 * Valid� les donn�es qui ont �t� post� par rapport a l'�v�nement
 */
class EventValidator extends Validator
{

    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        parent::validates($data);
        $this->validate('name', 'minLenght',3);
        $this->validate('date', 'date');
        $this->validate('start', 'beforeTime', 'end');
        return $this->errors;
    }

}