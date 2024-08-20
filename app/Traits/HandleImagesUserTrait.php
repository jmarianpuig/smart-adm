<?php

namespace App\Traits;

use App\Models\Actor;
use App\Models\Coordinator;
use App\Models\Xtra;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\Log;

trait HandleImagesUserTrait
{
    public function handleImages($request, Actor|Xtra|Coordinator $modelo)
    {
        // Definir un objeto con las rutas de guardado para cada tipo de modelo
        $savePaths = [
            Actor::class => '/actors/',
            Xtra::class => '/extras/',
            Coordinator::class => '/coordinators/'
        ];

        // Determinar la ruta de guardado según el tipo de modelo
        $savePath = $savePaths[get_class($modelo)] ?? null;

        if (!$savePath) {
            throw new \Exception('Modelo no soportado');
        }

        try {
            // Compruebo si vienen imágenes nuevas
            if ($request->hasAny(['img1', 'img2'])) {
                $imageAttributes = [
                    'img1' => [
                        'index' => 1,
                        'file' => $request->file('img1')
                    ],
                    'img2' => [
                        'index' => 2,
                        'file' => $request->file('img2')
                    ]
                ];

                // Itero sobre las imágenes
                foreach ($imageAttributes as $key => $attributes) {
                    $imageToUpdate = $modelo->imageables[$attributes['index']] ?? null;
                    $imageFile = $attributes['file'];
                    // Si existe la fila y hay una imagen nueva la renombro y la guardo
                    if ($imageToUpdate && $imageFile) {
                        $this->renameAndSaveNewImage($modelo, $imageToUpdate, $imageFile, $attributes, $savePath);
                    }
                }
            }

            // Renombrar las imágenes existentes si las slug, altura o tallas han cambiado
            $this->renameImagesIfSizesChanged($modelo, $savePath);
        } catch (\Exception $e) {
            Log::error('Error en el proceso de grabación de las imágenes: ' . $e->getMessage());
            toastr()->error('¡Ocurrió un error al actualizar las imágenes!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    // compruebo si hay imagens nuevas y las subo y renombro
    private function renameAndSaveNewImage($modelo, $imageToUpdate, $imageFile, $attributes, $savePath)
    {
        if ($modelo instanceof Coordinator) {
            $slug = $modelo->slug;

            // Construyo el nuevo nombre de la imagen
            $imageName = $slug . '-' . substr(md5(time()), 0, 16) . '.' . $imageFile->getClientOriginalExtension();
        } else {
            $slug = $modelo->slug;
            $height = $modelo->height;
            $pantSize = $modelo->pant_size->size;
            $shirtSize = $modelo->shirt_size->size;
            $shoeSize = $modelo->shoe_size->size;

            // Construyo el nuevo nombre de la imagen
            $imageName = $slug . '-' . $height . '-' . $pantSize . '-' . $shirtSize . '-' . $shoeSize . '-' . $attributes['index'] . '.' . $imageFile->getClientOriginalExtension();
        }

        // Elimino la imagen antigua del servidor
        $oldImagePath = getServerPath('images' . $savePath . $imageToUpdate->url);

        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Renombro la imagen y la subo a la carpeta
        $imageFile->move(getServerPath('images') . $savePath, $imageName);

        // Actualizo la URL en la tabla imageables
        $imageToUpdate->url = $imageName;
        $imageToUpdate->touch();
        $imageToUpdate->save();
    }

    // metodo para comprobar si las imagenes existen y darle el nuevo nombre
    private function renameImagesIfSizesChanged($modelo, $savePath)
    {
        try {
            if ($modelo instanceof Coordinator) {
                $slug = $modelo->slug;
                $imageables = $modelo->imageables;
                if (isset($imageables[1])) {
                    $imagePath = getServerPath('images') . $savePath . $imageables[1]->url;

                    if (File::exists($imagePath)) {
                        $newImageName = $slug . '-' . substr(md5(time()), 0, 16) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
                        File::move($imagePath, getServerPath('images') . $savePath . $newImageName);
                        $imageables[1]->url = $newImageName;
                        $imageables[1]->save();
                    }
                }
            } else {
                $slug = $modelo->slug;
                $height = $modelo->height;
                $pantSize = $modelo->pant_size->size;
                $shirtSize = $modelo->shirt_size->size;
                $shoeSize = $modelo->shoe_size->size;
                $imageables = $modelo->imageables;

                foreach ([1, 2] as $index) {
                    if (isset($imageables[$index])) {
                        $imagePath = getServerPath('images') . $savePath . $imageables[$index]->url;

                        if (File::exists($imagePath)) {
                            $newImageName = $slug . '-' . $height . '-' . $pantSize . '-' . $shirtSize . '-' . $shoeSize . "-$index." . pathinfo($imagePath, PATHINFO_EXTENSION);
                            File::move($imagePath, getServerPath('images') . $savePath . $newImageName);
                            $imageables[$index]->url = $newImageName;
                            $imageables[$index]->save();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error al dar los nuevos valores de tallas a las imágenes: ' . $e->getMessage());
            toastr()->error('¡Ocurrió un error al actualizar las imágenes, inténtelo de nuevo!', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
