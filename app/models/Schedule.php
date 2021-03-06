<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedule";
    public $primaryKey = "schedID";
    public $timestamps = false;
    public $incrementing = false;
}
