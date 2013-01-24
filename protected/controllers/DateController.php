<?php

class DateController extends Controller
{

	/**
	 * Illustrates the usage of Date component
	 *
	 */
	public function actionIndex(){
		//a sample date
		$date = '24-01-2013';
	
		//Returns current datetime formatted for MySQL with the timezone offset applied to it
		echo Yii::app()->Date->now();
		
		//Returns current datetime formatted for MySQL without the timezone offset applied to it
		echo Yii::app()->Date->now(false);
		
		
		//Formats almost any date string or timestamp to a MySQL compatible datetime string with the timezone offset applied to it
		echo Yii::app()->Date->toMYSQL($date);
		
		//Formats almost any date string or timestamp to a MySQL compatible datetime string without the timezone offset applied to it
		echo Yii::app()->Date->toMYSQL($date, false);
		
		
		//Returns the timestamp of current date in seconds with the timezone offset applied to it
		echo Yii::app()->Date->timestamp();
		
		//Returns the timestamp of current date in seconds without the timezone offset applied to it
		echo Yii::app()->Date->timestamp(false);
		
		
		//Returns a datetime string to add to database as default for datetime columns
		echo Yii::app()->Date->nullDateTime();
		
		
		////Returns a date string to add to database as default for date columns
		echo Yii::app()->Date->nullDate();
		
		
		//Given start and end dates in almost any format claculates the number of days within the interval
		echo Yii::app()->Date->daysCount('10-02-2013', '24-01-2013');
		
		
		//Given a year or a date string returns the number of days that the year contains (365 or 366)
		echo Yii::app()->Date->daysInYear($yearOrDate);
		
		
		//stop the execution
		Yii::app()->end();
	}
}
