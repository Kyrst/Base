<?php
// Truncate string
function truncate($str, $limit, $break = ' ', $pad = '...') {
    if ( strlen($str) <= $limit ) {
        return $str;
    }
    
    $str = substr($str, 0, $limit);
    
    if ( ($breakpoint = strrpos($str, $break)) !== false ) {
        $str = substr($str, 0, $breakpoint);
    }
    
    return $str . $pad;
}

// Convert DateTime object to relative time
function human_time(DateTime $time) {
    $now = new DateTime('now', new DateTimeZone(date_default_timezone_get()));
    
    $diff = $now->getTimestamp() - $time->getTimestamp();
    
    $diff_obj = $time->diff($now);
    
    $days_diff = $diff_obj->format('%d');
    
    $hours_diff = $diff_obj->format('%h');
    $mins_diff = $diff_obj->format('%m');
    $secs_diff = $diff_obj->format('%s');
    
    if ( $diff > 0 ) {
        if ( $days_diff > 0 ) {
            if ( $days_diff == 7 ) {
                return 'A week ago';
            } elseif ( $days_diff == 1 ) {
                return 'Yesterday';
            } else {
                return  $days_diff . ' days ago';
            }
        } else {
            if ( $hours_diff == 0 ) {
                return 'Now';
            } else {
                return $hours_diff . ' hours ago';
            }
        }
    } else {
        if ( $time->getTimestamp() < $now->getTimestamp() ) {
            return 'Now';
        } else {
            if ( $days_diff > 0 ) {
                if ( $days_diff == 1 ) {
                    return 'Tomorrow';
                } elseif ( $days_diff == 2 ) {
                    return 'Day after tomorrow';
                } else {
                    return 'In ' . $days_diff . ' days';
                }
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
}

// Calculate age from date
function birthdate_to_age(DateTime $birthdate) {
    $now = new DateTime('now', new DateTimeZone(date_default_timezone_get()));
    
    $diff_obj = $birthdate->diff($now);
    
    $years_diff = $diff_obj->format('%Y');
    $months_diff = $diff_obj->format('%m');
    $days_diff = $diff_obj->format('%d');
    
    if ( $days_diff < 0 || $months_diff < 0 ) {
        $years_diff--;
    }
    
    return $years_diff;
}

// Minify CSS
function minify_css($str) {
    // Remove comments
    $str = preg_replace('!/\*.*?\*/!s', '', $str);
    $str = preg_replace('/\n\s*\n/', "\n", $str);
    
    // Minify
    $str = preg_replace('/[\n\r \t]/', ' ', $str);
    $str = preg_replace('/ +/', ' ', $str);
    $str = preg_replace('/ ?([,:;{}]) ?/', '$1', $str);
    
    // Kill trailing semicolon
    $str = preg_replace('/;}/', '}', $str);
    
    return trim($str);
}
?>