<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide',
        'peopleCity',
        'peopleReceiver',
        'peoplePhone',
        'declaredValue',
        'amountToReceive',
        'address',
        'peopleIdentification',
        'shippingType',
        'width',
        'high',
        'long',
        'weight',
        'deliverySector',
        'toCollectDate',
        'peopleEmail',
        'observation'
    ];
}
