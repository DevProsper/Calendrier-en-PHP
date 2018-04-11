<?php
namespace App\Date;
use DateTime;
use Exception;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 11/04/2018
 * Time: 01:18
 */
class Month
{	
	public $days = ['Lundi', 'Mari','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    private $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'];
    public $month;
    public $year;
    /**
     * Month constructor
     * @param int $month Le mois compris entre 1 et 12
     * @param int $year L'année
     * @throws Exception
     */
    public function __construct(int $month = null, int $year = null){
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }
        if($year === null){
            $year = intval(date('Y'));
        }
        //$month = $month % 12;
        /*if($month < 1 && $month > 12){
        	throw new Exception("Le mois $month n'est pas valide");
        }
        if($year < 1970){
            throw new Exception("L'année est superieur a 1970");
        }*/
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Retourne le moi et l'année en toute lettre (ex: Mars 2018)
     * @return string
     */
    public function toString() : string{
        return $this->months[$this->month -1]. ' ' . $this->year;
    }

    /**
     * Renvoie le premier jour de moi
     * @return DateTime
     */
    public function getStartingDay() : DateTime{
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * Renvoie le nombre de semaine dans le moi
     * Trouvez le premier jour de notre moi, le dernier jour de notre moi, de prendre le numéro de semaine du premier jour
     * le numéro de semaine du dernier jour et de faire une soustraction
     * @return int
     */
    public function getWeeks() : int{
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks =  intval($end->format('W')) - intval($start->format('W')) + 1;
        if($weeks < 0){
            $weeks =  intval($end->format('W'));
        }
        return $weeks;
    }

    /**
     *Pour récupérer cette information, il suffit de comparer en formatant le moi et l'année de notre date
     * au moi et à l'année que l'on a au niveau du constructeur
     * Est-ce que le jour est dans le moi en cours
     * @param DateTime $date
     * @return bool
     */
    public function withinMonth(DateTime $date) : bool{
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Renvoie le moi suivant
     * @return Month
     */
    public function nextMonth() : Month{
        $month = $this->month +1;
        $year = $this->year;
        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }


    /**
     * Renvoie le moi précédent
     * @return Month
     */
    public function previousMonth() : Month{
        $month = $this->month - 1;
        $year = $this->year;
        if($month < 1){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }
}