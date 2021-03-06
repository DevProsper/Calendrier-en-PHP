<?php
namespace Calendar;
use DateTime;
use DateTimeInterface;
use Exception;

/**
 * Created by PhpStorm.
 * User: DevProsper
 * Calendar: 11/04/2018
 * Time: 01:18
 */
class Calendar
{
	public $days = ['Lundi', 'Mari','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    private $months = ['Janvier','F�vrier','Mars','Avril','Mai','Juin','Juillet','Aout',
    'Septembre','Octobre','Novembre','D�cembre'];
    public $month;
    public $year;

    /**
     * Month constructor
     * @param int $month Le mois compris entre 1 et 12
     * @param int $year L'ann�e
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
            throw new Exception("L'ann�e est superieur a 1970");
        }*/
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Retourne le moi et l'ann�e en toute lettre (ex: Mars 2018)
     * @return string
     */
    public function toString() : string{
        return $this->months[$this->month -1]. ' ' . $this->year;
    }

    /**
     * Renvoie le premier jour du moi
     * @return DateTimeInterface
     */
    public function getStartingDay() : \DateTimeInterface{
        return new \DateTimeImmutable("{$this->year}-{$this->month}-01");
    }

    /**
     * Renvoie le nombre de semaine dans le mois
     * Trouver le premier te le dernier jour du moi,obtenir le num�ro de la sema ine du premier jour,
     * le num�ro de la semaine du dernier jour et de faire une soustraction
     * @return int
     */
    public function getWeeks() : int {
        $start = $this->getStartingDay();
        $end = $start->modify('+1 month -1 day');
        $startweek = intval($start->format('W'));
        $endweek =  intval($end->format('W'));
        if($endweek === 1){
            $endweek = intval($end->modify('- 7 days')->format('W')) + 1;
        }
        $weeks = $endweek - $startweek + 1;
        if($weeks < 0){
            $weeks =  intval($end->format('W'));
        }
        return $weeks;
    }

    /**
     * Pour r�cup�rer cette information, il suffit de comparer en formatant le mois et l'ann�e de notre date
     * au moi et � l'ann�e que l'on a au niveau du constructeur
     * Est-ce que le jour est dans le moi en cours
     * @param DateTimeInterface $date
     * @return bool
     */
    public function withinMonth(DateTimeInterface $date) : bool{
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Renvoie le moi suivant
     * @return Calendar
     */
    public function nextMonth() : Calendar{
        $month = $this->month +1;
        $year = $this->year;
        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Calendar($month, $year);
    }

    /**
     * Renvoie le moi pr�c�dent
     * @return Calendar
     */
    public function previousMonth() : Calendar{
        $month = $this->month -1;
        $year = $this->year;
        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Calendar($month, $year);
    }
}