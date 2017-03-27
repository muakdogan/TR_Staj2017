<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Idea extends Model implements LogsActivityInterface
{
    use LogsActivity;
    
    public function getActivityDescriptionForEvent($eventName) {
        
        if ($eventName == 'created')
        {
        return 'Idea "' . $this->title . '" was created';
        }
         if ($eventName == 'login')
        {
        return 'Idea "' . $this->title . '" was created LOGİN OLDU';
        }
        if ($eventName == 'firmaProfili/uploadImage')
        {
        return 'Idea "' . $this->title . '" was created RESİM GÜNCELLEDİ';
        }
        if ($eventName == 'firmaProfili/iletisimAdd')
        {
        return 'Idea "' . $this->title . '" was updated İLETİŞİM BİLGİSİ EKLEDİ';
        }

        if ($eventName == 'updated')
        {
        return 'Idea "' . $this->title . '" was updated';
        }

        if ($eventName == 'deleted')
        {
        return 'Idea "' . $this->title . '" was deleted';
        }

        return '';
        }

}
