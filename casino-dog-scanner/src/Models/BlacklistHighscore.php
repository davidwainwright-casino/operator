<?php
namespace Wainwright\CasinoDogScanner\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class BlacklistHighscore extends Eloquent  {
    protected $table = 'wainwright_scanner_highscore';
    protected $timestamp = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'url',
        'additional_comments',
        'highest_points',
        'ww_id',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    public function wainwrightid()
    {
        return $this->belongsTo('Wainwright\CasinoDogScanner\WainwrightID', 'ww_id');
    }

}