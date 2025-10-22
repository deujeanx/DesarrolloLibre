<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'flight_id',
        'user_passenger_id',
        'user_payer_id',
        'token',
    ];

    //Relacion para la tabla vuelos
    public function flight():BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    //Relacion para la tabla user_passenger
    public function user_passenger():BelongsTo
    {
        return $this->belongsTo(UserPassenger::class);
    }

    //Relacion para la tabla user_payer
    public function user_payer():BelongsTo
    {
        return $this->belongsTo(UserPayer::class);
    }
}
