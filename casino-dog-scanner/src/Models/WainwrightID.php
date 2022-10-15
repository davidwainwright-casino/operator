<?php

namespace Wainwright\CasinoDogScanner\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class WainwrightID extends Eloquent  { //main ID of submissions & auto scans

    protected $table = 'wainwright_scanner_id';
    protected $timestamp = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'ww_id',
        'hostname',
        'comments',
        'url',
        'url_out',
        'software',
        'bl_modifier',
        'name',
        'type',
    ];

    protected $casts = [
        'data' => 'json',
        'hidden' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function blacklisthighscore(){
        return $this->belongsToMany('Wainwright\CasinoDogScanner\BlacklistHighscore', 'ww_id');
    }


    public function urlscanstate(){
        return $this->belongsToMany('Wainwright\CasinoDogScanner\BlacklistHighscore', 'ww_id');
    }

    public function report(){
        return $this->belongsToMany('Wainwright\CasinoDogScanner\BlacklistHighscore', 'ww_id');
    }


}



<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wainwright_scanner_id', function (Blueprint $table) {
            $table->id('id')->index();
            $table->string('ww_id', 200);
            $table->string('hostname', 200);
            $table->string('comments', 200);
            $table->string('url', 200);
            $table->string('url_out', 200);
            $table->string('software', 200);
            $table->string('bl_modifier', 200);
            $table->string('name', 200);
            $table->string('type', 200);
            $table->string('hidden', 200);
            $table->boolean('hidden', 15)->default(false);
            $table->string('imported_games', 25)->default('0');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wainwright_job_gameimporter');
    }
};