<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    public static function cast_float($number){
        $new = number_format((float)preg_replace('/[^A-Za-z0-9\.]/', '', $number), 2, '.', '');
        if($number[0] == '-')
            $new = '-'.$new;
        return $new;
    }

    public static function contains_number($str){
        if(strcspn($str, '0123456789') != strlen($str))
            return true;
        return false;
    }
    public static function delete_numbers($str){
        return preg_replace('/[0-9]+/', '', $str);
    }
    public static function fancy_date($fecha = NULL){
        if(empty($fecha)){
            return "Fecha inválida.";
        }
        
        $meses = [
            "[Mes 0]",
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ];
        $dia = date('d', strtotime($fecha));
        $mes = $meses[(int)date('m', strtotime($fecha))];
        $ano = date('Y', strtotime($fecha));
        return $dia." de ".$mes." de ".$ano;
    }
    public static function fancy_time($time = NULL, $showSeconds = false){
        if(empty($time)){
            return "Hora inválida.";
        }
        $time_eploded = explode(':', $time);
        $ampm = "AM";
        $hours = $time_eploded[0];
        if($hours > 12){
            $hours = $hours - 12;
            $ampm = "PM";
        }
        $minutes = $time_eploded[1];
        $seconds = $time_eploded[2];
        if($showSeconds)
            return $hours.":".$minutes.":".$seconds." ".$ampm;
        else
            return $hours.":".$minutes." ".$ampm;
    }
    public static function fancy_datetime ($datetime = null) {
        if(empty($datetime)){
            return "Hora inválida.";
        }
        $exploded = explode(" ", $datetime);
        return self::fancy_date($exploded[0])." a las ".self::fancy_time($exploded[1], true);
    }
}
