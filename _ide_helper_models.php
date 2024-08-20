<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $first_lname
 * @property string|null $second_lname
 * @property string $full_name
 * @property string|null $alias
 * @property string $slug
 * @property string $gender
 * @property string $phone
 * @property string|null $adress
 * @property int|null $zip_code
 * @property string $dni
 * @property string|null $ss
 * @property int $municipio_id
 * @property string $birthdate
 * @property int $study_id
 * @property int $hair_color_id
 * @property int $eye_color_id
 * @property int $race_id
 * @property int $has_car
 * @property int $is_disabled
 * @property int $height
 * @property int $pant_size_id
 * @property int $shirt_size_id
 * @property int $shoe_size_id
 * @property string|null $skills
 * @property int $is_extra
 * @property string|null $url_book
 * @property int $availability_id
 * @property int $has_tattoos
 * @property int $is_retired
 * @property int $removed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Availability $availability
 * @property-read \App\Models\Imageable|null $avatar
 * @property-read \App\Models\EyeColor $eye_color
 * @property-read mixed $age
 * @property-read mixed $formatted_alias
 * @property-read mixed $formatted_birthdate
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_dni
 * @property-read mixed $formatted_experience
 * @property-read mixed $formatted_has_car
 * @property-read mixed $formatted_has_tattoos
 * @property-read mixed $formatted_is_disabled
 * @property-read mixed $formatted_is_extra
 * @property-read mixed $formatted_is_retired
 * @property-read mixed $formatted_phone
 * @property-read \App\Models\HairColor $hair_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imageable> $imageables
 * @property-read int|null $imageables_count
 * @property-read \App\Models\Municipio $municipio
 * @property-read \App\Models\PantSize $pant_size
 * @property-read \App\Models\Race $race
 * @property-read \App\Models\ShirtSize $shirt_size
 * @property-read \App\Models\ShoeSize $shoe_size
 * @property-read \App\Models\Study $study
 * @property-read \App\Models\WebUser $user
 * @method static \Illuminate\Database\Eloquent\Builder|Actor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Actor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Actor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereAvailabilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereEyeColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereHairColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereHasCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereHasTattoos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereIsExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereIsRetired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor wherePantSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereRemoved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereShirtSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereShoeSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereSs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereStudyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereUrlBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Actor whereZipCode($value)
 */
	class Actor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $availability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|Availability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability query()
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Availability whereUpdatedAt($value)
 */
	class Availability extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $provincia
 * @property int $ca_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Provincia> $provincias
 * @property-read int|null $provincias_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ca whereCaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ca whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ca whereUpdatedAt($value)
 */
	class Ca extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $first_lname
 * @property string $second_lname
 * @property string $dni
 * @property string $ss
 * @property int $municipio_id
 * @property string $adress
 * @property int|null $zip_code
 * @property int $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereSs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coordinator whereZipCode($value)
 */
	class Coordinator extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $place
 * @property string $event_date
 * @property int $status
 * @property string $created_by
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $formatted_event_date
 * @property-read \App\Models\Provincia|null $provincia
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Viewer> $viewers
 * @property-read int|null $viewers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Event withoutTrashed()
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EyeColor whereUpdatedAt($value)
 */
	class EyeColor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HairColor whereUpdatedAt($value)
 */
	class HairColor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Imageable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imageable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imageable query()
 */
	class Imageable extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $municipio
 * @property int $provincia_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \App\Models\Provincia $provincia
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereMunicipio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereProvinciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereUpdatedAt($value)
 */
	class Municipio extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PantSize whereUpdatedAt($value)
 */
	class PantSize extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $first_lname
 * @property string|null $second_lname
 * @property string $full_name
 * @property string $dni
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $adress
 * @property-read mixed $age
 * @property-read mixed $formatted_alias
 * @property-read mixed $formatted_birthdate
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_dni
 * @property-read mixed $formatted_experience
 * @property-read mixed $formatted_has_car
 * @property-read mixed $formatted_has_tattoos
 * @property-read mixed $formatted_is_disabled
 * @property-read mixed $formatted_is_extra
 * @property-read mixed $formatted_is_retired
 * @property-read mixed $formatted_phone
 * @property-read mixed $skills
 * @property-read \App\Models\WebUser $user
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentDetail whereUserId($value)
 */
	class ParentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $provincia
 * @property int $ca_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ca $ca
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Municipio> $municipios
 * @property-read int|null $municipios_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia whereCaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provincia whereUpdatedAt($value)
 */
	class Provincia extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $coordinator_id
 * @property int $customer_id
 * @property string $name
 * @property string|null $description
 * @property int $municipio_id
 * @property string|null $start_date
 * @property string|null $finish_date
 * @property int $proyect_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereCoordinatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereProyectStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proyect whereUserId($value)
 */
	class Proyect extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectStatus whereUpdatedAt($value)
 */
	class ProyectStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $proyect_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers whereProyectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProyectsUsers whereUserId($value)
 */
	class ProyectsUsers extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $race
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|Race newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Race newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Race query()
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereRace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereUpdatedAt($value)
 */
	class Race extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShirtSize whereUpdatedAt($value)
 */
	class ShirtSize extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoeSize whereUpdatedAt($value)
 */
	class ShoeSize extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $study
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Actor> $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Xtra> $xtras
 * @property-read int|null $xtras_count
 * @method static \Illuminate\Database\Eloquent\Builder|Study newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Study newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Study query()
 * @method static \Illuminate\Database\Eloquent\Builder|Study whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Study whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Study whereStudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Study whereUpdatedAt($value)
 */
	class Study extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $first_lname
 * @property string $second_lname
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $created_by
 * @property string|null $created_by_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read mixed $adress
 * @property-read mixed $age
 * @property-read mixed $formatted_alias
 * @property-read mixed $formatted_birthdate
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_dni
 * @property-read mixed $formatted_experience
 * @property-read mixed $formatted_has_car
 * @property-read mixed $formatted_has_tattoos
 * @property-read mixed $formatted_is_disabled
 * @property-read mixed $formatted_is_extra
 * @property-read mixed $formatted_is_retired
 * @property-read mixed $formatted_phone
 * @property-read mixed $skills
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property int $provincia_id
 * @property string $email
 * @property string $phone
 * @property string $age
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read mixed $formatted_name
 * @property-read mixed $formatted_phone
 * @property-read mixed $formatted_provincia_id
 * @property-read \App\Models\Provincia $provincia
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereProvinciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Viewer whereUpdatedAt($value)
 */
	class Viewer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $first_lname
 * @property string|null $second_lname
 * @property string $full_name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Actor|null $actor
 * @property-read mixed $adress
 * @property-read mixed $age
 * @property-read mixed $formatted_alias
 * @property-read mixed $formatted_birthdate
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_dni
 * @property-read mixed $formatted_experience
 * @property-read mixed $formatted_has_car
 * @property-read mixed $formatted_has_tattoos
 * @property-read mixed $formatted_is_disabled
 * @property-read mixed $formatted_is_extra
 * @property-read mixed $formatted_is_retired
 * @property-read mixed $formatted_phone
 * @property-read mixed $skills
 * @property-read \App\Models\ParentDetail|null $parents
 * @property-read \App\Models\Xtra|null $xtra
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebUser whereUpdatedAt($value)
 */
	class WebUser extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $proyect_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay whereProyectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkDay whereUserId($value)
 */
	class WorkDay extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $first_lname
 * @property string|null $second_lname
 * @property string $full_name
 * @property string|null $alias
 * @property string $slug
 * @property string $gender
 * @property string $phone
 * @property string|null $adress
 * @property int|null $zip_code
 * @property string $dni
 * @property string|null $ss
 * @property int $municipio_id
 * @property string $birthdate
 * @property int $study_id
 * @property int $hair_color_id
 * @property int $eye_color_id
 * @property int $race_id
 * @property int $has_car
 * @property int $is_disabled
 * @property int $height
 * @property int $pant_size_id
 * @property int $shirt_size_id
 * @property int $shoe_size_id
 * @property string|null $skills
 * @property int $is_extra
 * @property string|null $url_book
 * @property int $availability_id
 * @property int $has_tattoos
 * @property int $is_retired
 * @property int $removed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Availability $availability
 * @property-read \App\Models\Imageable|null $avatar
 * @property-read \App\Models\EyeColor $eye_color
 * @property-read mixed $age
 * @property-read mixed $formatted_alias
 * @property-read mixed $formatted_birthdate
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_dni
 * @property-read mixed $formatted_experience
 * @property-read mixed $formatted_has_car
 * @property-read mixed $formatted_has_tattoos
 * @property-read mixed $formatted_is_disabled
 * @property-read mixed $formatted_is_extra
 * @property-read mixed $formatted_is_retired
 * @property-read mixed $formatted_phone
 * @property-read \App\Models\HairColor $hair_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imageable> $imageables
 * @property-read int|null $imageables_count
 * @property-read \App\Models\Municipio $municipio
 * @property-read \App\Models\PantSize $pant_size
 * @property-read \App\Models\Race $race
 * @property-read \App\Models\ShirtSize $shirt_size
 * @property-read \App\Models\ShoeSize $shoe_size
 * @property-read \App\Models\Study $study
 * @property-read \App\Models\WebUser $user
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereAvailabilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereEyeColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereFirstLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereHairColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereHasCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereHasTattoos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereIsDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereIsExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereIsRetired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra wherePantSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereRemoved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereSecondLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereShirtSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereShoeSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereSs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereStudyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereUrlBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xtra whereZipCode($value)
 */
	class Xtra extends \Eloquent {}
}

