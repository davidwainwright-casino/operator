<?php

namespace Wainwright\CasinoDogScanner\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class Report extends Eloquent  {

    protected $table = 'wainwright_scanner_report';
    protected $timestamp = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'report_id',
        'source',
        'ww_id',
    ];

    protected $casts = [
        'report_data' => 'json',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function wainwrightid()
    {
        return $this->belongsTo('Wainwright\CasinoDogScanner\WainwrightID', 'ww_id');
    }


}

