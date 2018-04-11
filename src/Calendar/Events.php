<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 11/04/2018
 * Time: 14:13
 */

namespace Calendar;


use PDO;

class Events
{

    /**
     * Récupère les événements entre deux dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetween(\DateTime $start, \DateTime $end) : array{
    	$pdo = new PDO('mysql:host=localhost;dbname=calendar', 'root', '',[
    		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    	]);
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}'
        AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupère les événements entre deux dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end) : array{
    	$events = $this->getEventsBetween($start, $end);
        
    }

}