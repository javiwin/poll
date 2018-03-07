<?php

/**
 * Created by .
 * User: Javi
 * Date: 19/12/2018
 * Time: 14:27
 */
class DateUtils
{

    public function DateUser2BD($userDate)
    {
        //funcion que recibe la fecha en este formato: '23/04/2015 12:34'
        //y la devuelve en este otro: '2015-04-23 12:34:00'
        $date_parts=explode(" ",$userDate);

        $date_DMY=explode("/",$date_parts[0]);

        $dateDB=$date_DMY[2]."-".$date_DMY[1]."-".$date_DMY[0];
        $dateDB.=" ".$date_parts[1].":00";

        return $dateDB;

    }

    function BD2DateUser($dateDB)
    {
        //funcion que recibe la fecha en este formato: '2015-04-23 12:34:00'
        //y la devuelve en este otro: '23/04/2015 12:34'

        $date_parts=explode(" ",$dateDB);

        $date_YMD=explode("-",$date_parts[0]);
        $date_HMS=explode(":",$date_parts[1]);


        $userDate= $date_YMD[2]."/". $date_YMD[1]."/". $date_YMD[0];

        $userDate.=" ".$date_HMS[0].":".$date_HMS[1];


        return $userDate;

    }

}