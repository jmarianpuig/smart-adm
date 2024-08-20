<?php

namespace App\Traits;

use App\Models\Actor;
use App\Models\Coordinator;
use App\Models\Xtra;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\Log;
use League\Flysystem\FileAttributes;

trait HandleFilesUserTrait
{
    public function handlefiles($request, Actor|Xtra|Coordinator $modelo)
    {
        // Definir un objeto con las rutas de guardado para cada tipo de modelo
        $savePaths = [
            Actor::class => 'files/actors/',
            Xtra::class => 'files/extras/',
            Coordinator::class => 'files/coordinators/'
        ];

        // Determinar la ruta de guardado según el tipo de modelo
        $savePath = $savePaths[get_class($modelo)] ?? null;

        if (!$savePath) {
            throw new \Exception('Modelo no soportado');
        }

        try {
            // compruebo si viene archivos nuevos (por ahora solo hay uno... preparado para mas)
            if ($request->hasAny(['file1'])) {
                $fileAttributes = [
                    'file1' => [
                        'file' => $request->file('file1')
                    ]
                ];
 
                // Itero sobre los archivos (por ahora solo hay uno... preparado para mas)
                foreach ($fileAttributes as $key => $attributes) {
                    $fileToUpdate = $modelo->fileables ?? null;
                    $file = $attributes['file'];

                    // Si existe la fila y hay una archivo nuevo lo renombro y la guardo
                    if ($fileToUpdate && $file) {
                        $this->renameAndSaveNewFile($modelo, $fileToUpdate, $file, $attributes, $savePath);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error en el proceso de grabación de los archivos: ' . $e->getMessage());
            toastr()->error('¡Ocurrió un error al actualizar los archivos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    // compruebo si hay imagens nuevas y las subo y renombro
    private function renameAndSaveNewFile($modelo, $fileToUpdate, $file, $attributes, $savePath)
    {

        if ($modelo instanceof Coordinator) {
            $slug = $modelo->slug;

            // Construyo el nuevo nombre del archivo
            $fileName = $slug . '-' . substr(md5(time()), 0, 16) . '.' . $file->getClientOriginalExtension();
        } else {
            // otros modelos ... $attributes Xtra|Actor
        }

        // Elimino el archivo antiguo del servidor
        $oldFilePath = 'C:/xampp/htdocs/frontal/public/' . $savePath . $fileToUpdate->url;
        // $oldFilePath = public_path($savePath . $fileToUpdate->url);

        if (File::exists($oldFilePath)) {
            File::delete($oldFilePath);
        }

        // Renombro la imagen y la subo a la carpeta
        $file->move('C:/xampp/htdocs/frontal/public/' . $savePath, $fileName);
        // $file->move(public_path($savePath), $fileName);

        // Actualizo la URL en la tabla imageables
        $fileToUpdate->url = $fileName;
        $fileToUpdate->touch();
        $fileToUpdate->save();
    }
}
