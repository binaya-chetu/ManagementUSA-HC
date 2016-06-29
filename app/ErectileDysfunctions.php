<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErectileDysfunctions extends Model
{
    protected $table = 'erectile_dysfunctions';
    protected $fillable = [
		'id',
		'patient_id',
		'sex_status',
		'sex_often',
		'sex_with',
		'pronography',
		'prostate_removal',
		'nerve_damage',
		'erectile',
		'implant',
		'penis_pump',
		'recreational',
		'ejaculate',
		'medicine_used',
		'sickle',
		'dwarfing',
		'hiv',
		'sex_medicine',
		'medicine_name',
		'medicine_work',
		'last_used',
		'still_work',
		'side_effect',
		'erection_time',
		'erection_kind',
		'erection_strength',
		'activity_score',
		'stimulation_score',
		'intercourse_score',
		'maintain_score',
		'difficult_score',
		'created_at',
		'updated_at'	
	];
}
