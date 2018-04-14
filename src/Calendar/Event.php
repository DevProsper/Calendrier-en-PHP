<?php
namespace Calendar;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 12/04/2018
 * Time: 03:07
 */



use DateTime;

class Event
{
    private $id;

    private $name;

    private $description;

    private $start;

    private $end;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description ?? '';
    }

    /**
     * @return DateTime
     */
    public function getStart() : DateTime
    {
        return new DateTime($this->start);
    }

    /**
     * @return DateTime
     */
    public function getEnd() : DateTime
    {
        return new DateTime($this->end);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }


}