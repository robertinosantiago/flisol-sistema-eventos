<?php

App::uses('AppModel', 'Model');
APP::uses('ModelBehavior', 'Model');


class DateFormatBehavior extends ModelBehavior {
    
    public function afterFind(Model $model, $results, $primary = false) {
        $res = array();
        
        foreach ($results as $key => $value) {
            
            if (is_array($value)) {
                $res[$key] = self::afterFind($model, $value, $primary);
            } else {
                $columns = $model->getColumnTypes();
                foreach ($columns as $column => $type) {
                    if ($type != 'date') unset($columns[$column]);
                }
                
                if (array_key_exists($key, $columns)) {
                    foreach ($columns as $column => $type) {
                        $res[$column] = $this->__toDate($value);
                    }
                } else {
                    $res[$key] = $value;
                }
            }
        }
        
        return $res;
    }
    
    
    private function __toDate($date, $fromFormat = 'Y-m-d', $toFormat = 'd/m/Y') {
        $schedule = $date;
        $schedule_format = str_replace(array('Y', 'm', 'd', 'H', 'i', 'a'), array('%Y', '%m', '%d', '%I', '%M', '%p'), $fromFormat);
        $ugly = strptime($schedule, $schedule_format);
        $ymd = sprintf(
                '%04d-%02d-%02d %02d:%02d:%02d', $ugly['tm_year'] + 1900, // This will be "111", so we need to add 1900.
                $ugly['tm_mon'] + 1, // This will be the month minus one, so we add one.
                $ugly['tm_mday'], $ugly['tm_hour'], $ugly['tm_min'], $ugly['tm_sec']
        );
        $new_schedule = new DateTime($ymd);

        return $new_schedule->format($toFormat);
    }
    
    
}