<?php

namespace App\Traits;

use Carbon\Carbon;

trait AttributeHelpersTrait
{
    // setters para nombres, direccion, email
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtolower($value);
    }

    public function setFirstLnameAttribute($value)
    {
        $this->attributes['first_lname'] = mb_strtolower($value);
    }

    public function setSecondLnameAttribute($value)
    {
        $this->attributes['second_lname'] = mb_strtolower($value);
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = mb_strtolower($value);
    }

    public function SetAdressAttribute($value)
    {
        $this->attributes['adress'] = mb_strtolower($value);
    }

    public function SetEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value);
    }

    public function SetSkillsAttribute($value)
    {
        $this->attributes['skills'] = mb_strtolower($value);
    }

    // mutadores
    // edad actual en años
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    // formatear el telefono xxx xxx xxx
    public function getFormattedPhoneAttribute()
    {
        return substr($this->phone, 0, 3) . ' ' . substr($this->phone, 3, 3) . ' ' . substr($this->phone, 6, 3);
    }

    // dni/nie
    public function getFormattedDniAttribute()
    {
        if (substr($this->dni, 0, 1) === '9') {
            return 'Falta Dni/Nie';
        } elseif (preg_match("/^[XYZ]/", $this->dni)) {
            return substr($this->dni, 0, 8) . '-' . substr($this->dni, 8, 1);
        } else {
            return substr($this->dni, 0, 2) . '.' . substr($this->dni, 2, 3) . '.' . substr($this->dni, 5, 3) . '-' . substr($this->dni, 8, 1);
        }
    }

    // fecha en formato de españa
    public function getFormattedBirthdateAttribute()
    {
        return Carbon::parse($this->birthdate)->format('d-m-Y');
    }

    // fecha en formato de españa
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    // nombre y apellidos
    public function getNameAttribute()
    {
        return ucwords($this->attributes['name']);
    }

    public function getFirstLnameAttribute()
    {
        return ucwords($this->attributes['first_lname']);
    }

    public function getSecondLnameAttribute()
    {
        return ucwords($this->attributes['second_lname']);
    }

    // nombre completo
    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['full_name']);
    }
    // public function getFullNameAttribute()
    // {
    //     return ucwords(mb_strtolower($this->attributes['name'] . ' ' . $this->attributes['first_lname'] . ' ' . $this->attributes['second_lname']));
    // }

    // nombre artistico
    public function getFormattedAliasAttribute()
    {
        return ucwords(mb_strtolower($this->attributes['alias']));
    }

    // direccion
    public function getAdressAttribute()
    {
        return ucfirst($this->attributes['adress']);
    }

    // discapacidad y coche
    public function getFormattedHasCarAttribute()
    {
        return (!$this->has_car) ? 'No' : 'Sí';
    }

    public function getFormattedIsDisabledAttribute()
    {
        return (!$this->is_disabled) ? 'No' : 'Sí';
    }

    // harias figuracion
    public function getFormattedIsExtraAttribute()
    {
        return (!$this->is_extra) ? 'No' : 'Sí';
    }

    // esta jubilado
    public function getFormattedIsRetiredAttribute()
    {
        return (!$this->is_retired) ? 'No' : 'Sí';
    }

    // tiene tatuajes visibles
    public function getFormattedHasTattoosAttribute()
    {
        return (!$this->has_tattoos) ? 'No' : 'Sí';
    }

    // skillsextras
    public function getSkillsAttribute()
    {
        return ucfirst($this->attributes['skills']);
    }

    // experiencia
    public function getFormattedExperienceAttribute()
    {
        return (!$this->experience) ? 'No' : 'Sí';
    }
}

