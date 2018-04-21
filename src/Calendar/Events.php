<?php
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 11/04/2018
 * Time: 14:13
 */

namespace Calendar;


use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use PDO;

class Events
{

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    /**
     * R�cup�re les �v�nements entre deux dates
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
    public function getEventsBetween(\DateTimeInterface $start, DateTimeInterface $end) : array{
    	
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}'
        AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start DESC ";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * R�cup�re les �v�nements entre deux dates index� par jour
     * @param \DateTimeInterface $start
     * @param DateTimeInterface $end
     * @return array
     */
    public function getEventsBetweenByDay(\DateTimeInterface $start, \DateTimeInterface $end) : array{
    	$events = $this->getEventsBetween($start, $end);
        $days =  [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            }else{
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * Renvoie un �v�nement
     * @param int|int $id
     * @return Event
     * @throws \Exception
     */
    public function find(int $id) : Event {
        $statement =  $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if($result === false){
             throw new \Exception("Aucun r�sultat n'a �t� trouv�");
        }else{
            return $result;
        }
    }

    /**
     * Cr�er un �v�nement
     * @param Event $event
     * @return bool
     */
    public function create(Event $event): bool{
        $statement = $this->pdo->prepare("INSERT INTO events (name,description,start,end) VALUES(?,?,?,?)");
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
        ]);
    }

    public function hydrate(Event $event, array $data){
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTimeImmutable::createFromFormat('Y-m-d H:i', $data['date'] . ' ' .$data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTimeImmutable::createFromFormat('Y-m-d H:i', $data['date'] . ' ' .$data['end'])->format('Y-m-d H:i:s'));
        return $event;
    }

    /**
     * Modification de l'�v�nement un �v�nement
     * @param Event $event
     * @return bool
     */
    public function update(Event $event): bool{
        $statement = $this->pdo->prepare("UPDATE events SET name = ?,description = ?,start = ?,end = ? WHERE id=?");
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);
    }

}