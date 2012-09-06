<?php
function relative_date($ts)
{
    if(!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 60) return 'Just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) return 'Yesterday';
        if($day_diff < 7) return $day_diff . ' days ago';
        if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
        if($day_diff < 60) return 'Last month';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'In a minute';
            if($diff < 3600) return 'In ' . floor($diff / 60) . ' minutes';
            if($diff < 7200) return 'In an hour';
            if($diff < 86400) return 'In ' . floor($diff / 3600) . ' hours';
        }
        if($day_diff == 1) return 'Tomorrow';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'Next week';
        if(ceil($day_diff / 7) < 4) return 'In ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'Next month';
        return date('F Y', $ts);
    }
}

function truncate($string, $limit, $break=" ", $pad="...") {
// return with no change if string is shorter than $limit
if(strlen($string) <= $limit) return $string;
$string = substr($string, 0, $limit);
if(false !== ($breakpoint = strrpos($string, $break))) {
$string = substr($string, 0, $breakpoint);
}
return $string . $pad;
}

function array_random($arr, $num = 1) {
    shuffle($arr);
   
    $r = array();
    for ($i = 0; $i < $num; $i++) {
        $r[] = $arr[$i];
    }
    return $num == 1 ? $r[0] : $r;
}

function get_weekdays() {
    return array(
        1 => 'Monday',
        'Thuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    );
}

function human_time(DateTime $time, DateTime $end_time, DateTimeZone $timezone, $date_output = true, $time_output = true) {    
    $now = new DateTime();
    
    $diff = $now->getTimestamp() - $time->getTimestamp();
    
    $diff_obj = $time->diff($now);
    
    $hours_diff = $diff_obj->format('%h');
    $mins_diff = $diff_obj->format('%m');
    $secs_diff = $diff_obj->format('%s');
    
    if ( $diff > 0 ) {
        return $hours_diff . ' hours ago';
    } else {
        if ( $time->getTimestamp() < $end_time->getTimestamp() ) {
            return 'Now';
        } else {
            if ( $hours_diff > 0 ) {
                return 'In ' . $hours_diff . ' hours';
            } else {
                if ( $mins_diff > 0 ) {
                    return 'In ' . $mins_diff . ' mins';
                } else {
                    return 'In ' . $secs_diff . ' secs';
                }
            }
        }
    }
}

  function birthdate_to_age ($birthday){
    list($year,$month,$day) = explode("-",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
  }
?>