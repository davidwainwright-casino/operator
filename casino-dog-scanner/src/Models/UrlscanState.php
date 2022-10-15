<?php

namespace Wainwright\CasinoDogScanner\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class UrlscanState extends Eloquent  {

    protected $table = 'wainwright_scanner_urlscan_state';
    protected $timestamp = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'state',
        'url',
        'created_at',
        'updated_at',
        'ww_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function wainwrightid()
    {
        return $this->belongsTo('Wainwright\CasinoDogScanner\WainwrightID', 'ww_id');
    }


}

