<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operation';
    protected $primaryKey = 'ID';
    protected $keyType = 'int';

    protected $fillable = [
        'ID',
        'TB', // Tug Boat
        'BG', // Barge
        'VOY', // Voyage
        'BARGES_OWNERS_OPERATOR',
        'SHIPPER',
        'COMODITIES',
        'CONTACT_MASTER_CAPTAIN',
        'LAYCAN',
        'POL', // Port of Loading
        'AGENT_POL',
        'PIC_POL', // Person in Charge at Port of Loading
        'CONTACT_AGENT_POL',
        'ETA_POL', // Estimated Time of Arrival at Port of Loading
        'TA_POL', // Time of Arrival at Port of Loading
        'TB_POL', // Time Berthed at Port of Loading
        'SL', // Start Loading
        'CL', // Completed Loading
        'CO_POL', // Cast Off at Port of Loading
        'TD_POL', // Time Departed from Port of Loading
        'DS_POL', // Draft Survey at Port of Loading
        'POD', // Port of Discharge
        'AGENT_POD',
        'PIC_POD', // Person in Charge at Port of Discharge
        'CONTACT_AGENT_POD',
        'ETA_POD', // Estimated Time of Arrival at Port of Discharge
        'TA_POD', // Time of Arrival at Port of Discharge
        'TB_POD', // Time Berthing at Port of Discharge
        'SD', // Start Discharging
        'CD', // Completed Discharging
        'CO_POD', // Cast Off at Port of Discharge
        'TD_POD', // Time Departure at Port of Discharge
        'DS_POD', // Draft Survey at Port of Discharge
        'LAYTIME_POL',
        'LAYTIME_POD',
        'TOTAL_LAYTIME',
        'LAYTIME_ALLOWED',
        'DEMURRAGE_DESPATCH',
        'POSITION',
        'REMARKS_STATUS',
        'created_at',
        'updated_at'
    ];
}