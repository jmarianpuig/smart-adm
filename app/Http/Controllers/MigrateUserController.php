<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Xtra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MigrateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:migrate.actorToExtra', ['only' => ['actorToExtra']]);
        $this->middleware('permission:migrate.extraToActor', ['only' => ['extraToActor']]);
    }

    public function actorToExtra($actor_id)
    {
        // Obtener el actor con su id 
        $actorToMigrate = Actor::where('id', $actor_id)->first();

        if (!$actorToMigrate) {
            return redirect()->back()->with('error', 'No hay actores para migrar');
        } else {
            // Iniciar una transacción para asegurar atomicidad
            DB::transaction(function () use ($actorToMigrate) {

                // Crear un nuevo registro de Xtra con los datos del Actor
                $extra = new Xtra();

                // Copiar los campos necesarios del Actor a Xtra
                $actorAttributes = $actorToMigrate->getAttributes();
                unset($actorAttributes['id']); // Excluir el campo 'id'
                // unset($actorAttributes['is_extra']); // Excluir el campo 'is_actor'

                // Asignar los atributos al modelo Xtra
                $extra->fill($actorAttributes);

                // Guardar el nuevo Xtra para obtener un nuevo ID
                $extra->save();

                // Obtener el nuevo ID de Xtra
                $newExtraId = $extra->id;

                // Migrar las imágenes asociadas y actualizar el nombre de las imágenes
                // foreach ($actorToMigrate->imageables as $index => $image) {
                //     if ($index == 0) {
                //         // si existe el avatar por ahora solo cambiamos el modelo y el nuevo id 
                //         $image->imageable_id = $newExtraId;
                //         $image->imageable_type = Xtra::class;
                //         $image->save();

                //     } else {
                //         // Para las otras imágenes, actualizar la referencia en la tabla imageables
                //         // $oldImagePath = public_path('images/actors/' . $image->url);
                //         $oldImagePath = getImagePath() . '/actors/' . $image->url;
                //         $newImageName = $this->generateImageName($extra, $index, pathinfo($image->url, PATHINFO_EXTENSION));
                //         // $newImagePath = public_path('images/extras/' . $newImageName);
                //         $newImagePath = getImagePath() . '/extras/' . $newImageName;

                //         // Mover la imagen al nuevo directorio
                //         if (File::exists($oldImagePath)) {
                //             File::move($oldImagePath, $newImagePath);

                //             // Actualizar la referencia en la tabla imageables para la imagen
                //             $image->url = $newImageName;
                //             $image->imageable_id = $newExtraId;
                //             $image->imageable_type = Xtra::class;
                //             $image->is_avatar = false; // Asegurarse de que no es el avatar
                //             $image->save();
                //         }
                //     }
                foreach ($actorToMigrate->imageables as $index => $image) {
                    if ($index == 0) {
                        // si existe el avatar por ahora solo cambiamos el modelo y el nuevo id 
                        $image->imageable_id = $newExtraId;
                        $image->imageable_type = Xtra::class;
                        $image->save();
                    } else {
                        // Convertir la URL en una ruta de archivo del sistema
                        $oldImagePath = '/var/www/vhosts/39946890.servicio-online.net/smartfiguracion.es/public/images/actors/' . $image->url;
                        $newImageName = $this->generateImageName($extra, $index, pathinfo($image->url, PATHINFO_EXTENSION));
                        $newImagePath = '/var/www/vhosts/39946890.servicio-online.net/smartfiguracion.es/public/images/extras/' . $newImageName;

                        //  Verificar las rutas generadas
                        // dd([
                        //     'oldImagePath' => $oldImagePath,
                        //     'file_exists_oldImagePath' => File::exists($oldImagePath),
                        //     'newImagePath' => $newImagePath
                        // ]);

                        // Mover la imagen al nuevo directorio
                        if (File::exists($oldImagePath)) {
                            File::move($oldImagePath, $newImagePath);

                            // Actualizar la referencia en la tabla imageables para la imagen
                            $image->url = $newImageName;
                            $image->imageable_id = $newExtraId;
                            $image->imageable_type = Xtra::class;
                            $image->is_avatar = false; // Asegurarse de que no es el avatar
                            $image->save();
                        } else {
                            dd("La imagen no existe: " . $oldImagePath);
                        }
                    }
                }
                // Eliminar el registro original del Actor sin propagar la eliminación al usuario
                $actorToMigrate->deleteActor();
            });

            // Retornar una respuesta o redirigir según sea necesario
            return redirect()->back()->with('success', 'Migración completada con éxito');
        }
    }

    public function extraToActor($extra_id)
    {
        // Obtener todos los actores con url_book como NULL
        $extraToMigrate = Xtra::where('id', $extra_id)->first();

        if (!$extraToMigrate) {
            return redirect()->back()->with('error', 'No hay extras para migrar');
        } else {
            // dd($extraToMigrate);
            // Iniciar una transacción para asegurar atomicidad
            DB::transaction(function () use ($extraToMigrate) {
                // Crear un nuevo registro de Actor con los datos del extra
                $actor = new Actor();

                // Copiar los campos necesarios del extra a actor
                $extraAttributes = $extraToMigrate->getAttributes();
                unset($extraAttributes['id']); // Excluir el campo 'id'
                // unset($extraAttributes['skills']); // Excluir el campo 'is_actor'

                // Asignar los atributos al modelo Actor
                $actor->fill($extraAttributes);

                // Guardar el nuevo Actor para obtener un nuevo ID
                $actor->save();

                // Obtener el nuevo ID de Actor
                $newActorId = $actor->id;

                // Migrar las imágenes asociadas y actualizar el nombre de las imágenes
                foreach ($extraToMigrate->imageables as $index => $image) {
                    if ($index == 0) {
                        // si exiuste el avatar por ahora solo cambiamos el modelo y el nuevo id 
                        $image->imageable_id = $newActorId;
                        $image->imageable_type = Actor::class;
                        $image->save();
                    } else {
                        // Para las otras imágenes, actualizar la referencia en la tabla imageables
                        // $oldImagePath = 'C:/xampp/htdocs/frontal/public/images/extras/' . $image->url;
                        $oldImagePath = '/var/www/vhosts/39946890.servicio-online.net/smartfiguracion.es/public/images/extras/' . $image->url;
                        $newImageName = $this->generateImageName($actor, $index, pathinfo($image->url, PATHINFO_EXTENSION));
                        $newImagePath = '/var/www/vhosts/39946890.servicio-online.net/smartfiguracion.es/public/images/actors/' . $newImageName;

                        // Mover la imagen al nuevo directorio
                        if (File::exists($oldImagePath)) {
                            File::move($oldImagePath, $newImagePath);

                            // Actualizar la referencia en la tabla imageables para la imagen
                            $image->url = $newImageName;
                            $image->imageable_id = $newActorId;
                            $image->imageable_type = Actor::class;
                            $image->is_avatar = false; // Asegurarse de que no es el avatar
                            $image->save();
                        } else {
                            dd("La imagen no existe: " . $oldImagePath);
                        }
                    }
                }

                // Eliminar el registro original del extra sin propagar la eliminación al usuario
                $extraToMigrate->deleteExtra();
            });

            // Retornar una respuesta o redirigir según sea necesario
            return redirect()->back()->with('success', 'Migración completada con éxito');
        }
    }


    //Generar el nombre de la imagen basado en los atributos del modelo Actor o Xtra
    private function generateImageName($model, $index, $extension)
    {
        $pantSize = $model->pant_size ? $model->pant_size->size : 'N/A';
        $shirtSize = $model->shirt_size ? $model->shirt_size->size : 'N/A';
        $shoeSize = $model->shoe_size ? $model->shoe_size->size : 'N/A';

        return $model->slug . '-' . $model->height . '-' . $pantSize . '-' . $shirtSize . '-' . $shoeSize . '-' . $index . '.' . $extension;
    }
}
