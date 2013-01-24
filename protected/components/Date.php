<?php
/**
 * Date.php
 *
 * https://github.com/stdevteam/yii-date
 *
 * @author STDev <yii@st-dev.com>
 * @copyright 2013 STDev http://st-dev.com
 * @license released under dual license BSD License and MIT License
 * @package Date
 * @version 1.0
 */
class Date extends CComponent{
    /**
	 * And integer that holds the offset of hours from GMT e.g. 4 for GMT +4 
	 *
     * @var int
     */
    public $offset = null;

    public function  __construct(){
        $this->offset = 4;
    }
    
    public function init(){
        
    }
    
    /**
     * Method to return current date time in format suitable for database insertion
     * @param bool $local Weather or not to return date time in local timezone or not, defaults to true
     * @return string The database compatible date time
     */
    public function now($local = true){
        $time = time();
        if($local){
         $time += ($this->offset * 3600);
        }
        return gmdate("Y-m-d H:i:s", $time);
    }
    /**
     * Method to format datetime string or timestamp passed to $date into database compatible representation
     * @param string|int $date Either datetime string or int timestamp,
     * if this parameter is invalid value of time() will be used instead
     * @param bool $local Weather or not to return date time in local timezone or not, defaults to true
     * @return string The database compatible datetime
     */
    public function toMysql($date, $local = true){
        $date = trim($date);
        if(empty($date) /*|| strtotime($date) === false*/){
            $date = time();
        }
        if(!is_numeric($date)){
            $date = strtotime($date);
        }
        if($local){
            $date = $date + ($this->offset * 3600);
        }

        return gmdate("Y-m-d H:i:s", $date);
    }
    /**
     * Method to get current Unix timestamp optionally in local timezone
     * @param bool $local Weather or not to return the timestamp in local timezone or not, defaults to true
     * @return int Unix timestamp
     */
    public function timestamp($local = true){
        $stamp = time();
        if($local){
            $stamp += ($this->offset * 3600);
        }
        return $stamp;
    }
    /**
     * Method to get default value for datetime columns in databases
     * @return string Default value for datetime columns
     */
    public function nullDateTime(){
        return "0000-00-00 00:00:00";
    }
    /**
     * Method to get default value for date columns in databases
     * @return string Default value for date columns
     */
    public function nullDate(){
        return "0000-00-00";
    }
    /**
     * Method to format datetime string or timestamp passed to $date
     * into database compatible representation for date columns
     * @param string|int $date Either datetime string or int timestamp,
     * if this parameter is invalid value of time() will be used instead
     * @param bool $local Weather or not to return date time in local timezone or not, defaults to true
     * @return string The database compatible date column value
     */
    public function dateToMysql($date, $local = true){
        $date = trim($date);
        if(empty($date) || strtotime($date) === false){
            $date = time();
        }

        if(!is_numeric($date)){
            $date = strtotime($date);
        }

        if($local){
            $date = $date + ($this->offset * 3600);
        }

        return gmdate("Y-m-d", $date);
    }
    /**
     * Method to get days interval between to dates passed
     * @param string $endDate The date until which to count
     * @param string $beginDate The date starting which to count
     * @return int Number of days that are between the two days passed
     */
    public function daysCount($endDate, $beginDate){
       //explode the date by "-" and storing to array
       $datePartsBegin  = explode("-", date("Y-m-d", strtotime($beginDate)));
       $datePartsEnd    = explode("-", date("Y-m-d", strtotime($endDate)));
       
       //gregoriantojd() Converts a Gregorian date to Julian Day Count
       $startDate   = gregoriantojd($datePartsBegin[1], $datePartsBegin[2], $datePartsBegin[0]);
       $endDate     = gregoriantojd($datePartsEnd[1], $datePartsEnd[2], $datePartsEnd[0]);
       
       return $endDate - $startDate;
    }
    /**
     * Method to get number of days in a particular year
     * @param string $yearOrDate Either Year or date to fetch number of days from
     * @return int Number of days in specified year
     */
    public function daysInYear($yearOrDate){

        if(!is_numeric($yearOrDate)){
            $year = date("Y", strtotime($yearOrDate));
        }else{
            $year = $yearOrDate;
        }

        return (int)(date("z", mktime(0,0,0,12,31,$year)) + 1);
    }
    /**
     * @return int The offset for timezones
     */
    public function getOffset(){
        return $this->offset;
    }

    public function setOffset($offset){
        $this->offset = $offset;
    }
}