<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Model::class);
    }

    public function compatibilities()
    {
        return $this->belongsToMany(Phone::class, 'phone_compatibilities', 'phone_id_1', 'phone_id_2')->withPivot('verified', 'possible');
    }

    public function addCompatibility(Phone $otherPhone)
    {
        // Verifica se la compatibilità esiste già
        if (!$this->compatibilities()->where('phone_id_2', $otherPhone->id)->exists()) {
            // Aggiungi la compatibilità in una direzione
            $this->compatibilities()->attach($otherPhone->id);
        }

        // Verifica se la compatibilità inversa esiste già
        if (!$otherPhone->compatibilities()->where('phone_id_2', $this->id)->exists()) {
            // Aggiungi la compatibilità nell'altra direzione
            $otherPhone->compatibilities()->attach($this->id);
        }
    }
}
