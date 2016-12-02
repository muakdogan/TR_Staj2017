<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParaBirimi extends Model
{
    //
    protected $table = 'para_birimleri';
    
    public function ilanlar()
    {
        return $this->hasMany('App\Ilan', 'para_birimi_id', 'id');
    }
    public function mal_teklifler()
    {
        return $this->hasMany('App\MalTeklif', 'para_birimleri_id', 'id');
    }
    public function hizmet_teklifler()
    {
        return $this->hasMany('App\HizmetTeklif', 'para_birimleri_id', 'id');
    }
    public function goturu_bedeller_teklifler()
    {
        return $this->hasMany('App\GoturuBedelTeklif', 'para_birimleri_id', 'id');
    }
    public function yapim_isi_teklifler()
    {
        return $this->hasMany('App\YapimIsiTeklif', 'para_birimleri_id', 'id');
    }
}
