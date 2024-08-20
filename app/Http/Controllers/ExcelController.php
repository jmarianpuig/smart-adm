<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Viewer;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;

class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:exports.excel', ['only' => ['exportExcel']]);
        $this->middleware('permission:exports.pdf', ['only' => ['exportPdf']]);
        $this->middleware('permission:exportsYounger.excel', ['only' => ['exportExcelYounger']]);
        $this->middleware('permission:exportsYounger.pdf', ['only' => ['exportPdfYounger']]);
        $this->middleware('permission:exportsCoordinator.excel', ['only' => ['exportExcelCoordinator']]);
        $this->middleware('permission:exportsCoordinator.pdf', ['only' => ['exportPdfCoordinator']]);
    }

    // Excel para Extras y Actores
    public function exportExcel($modelType, $info)
    {
        try {
            // Obtengo el nombre completo del modelo basado en $modelType
            $modelClassName = 'App\Models\\' . $modelType;
            // Traigo los datos según el modelo
            $info = $modelClassName::find($info);

            if (!$info) {
                Log::error('No hay datos: ' . $info->id);
                toastr()->error('¡No hay datos seleccionados!', 'Error');
                return redirect()->back()->withInput();
            }

            // Crear un escritor de SimpleExcel
            $stream = SimpleExcelWriter::streamDownload($info->full_name . '.xlsx');

            $writer = $stream->getWriter();

            // Set the name of the current sheet to 'Datos'
            $nameSheet = $writer->getCurrentSheet();
            $nameSheet->setName('Datos');

            // Definir el estilo de la cabecera
            $headerStyle = (new Style())
                ->setFontBold()
                ->setFontSize(12)
                ->setFontColor(Color::WHITE)
                ->setBackgroundColor(Color::LIGHT_BLUE)
                ->setCellAlignment(CellAlignment::CENTER);

            // Crear la fila de la cabecera con el estilo
            $headerRow = Row::fromValues([
                'Nombre', 'Apellidos', 'N. Artístico', 'Tel.', 'DNI/NIE', 'SegSoc', 'Fec. Nac.', 'Calle', 'Municipio', 'Provincia', 'Nº Cuenta', 'Email'
            ], $headerStyle);

            $stream->addRow($headerRow);

            // Formatear la fecha de nacimiento
            $age = Carbon::createFromFormat('Y-m-d', $info->birthdate)->format('d-m-Y');

            // Crear la fila de datos
            $dataRow = [
                ucwords($info->name),
                ucwords($info->first_lname . ' ' . $info->second_lname),
                ucwords($info->formattedAlias),
                $info->formattedPhone,
                $info->formattedDni,
                $info->ss,
                $age,
                $info->adress,
                $info->municipio->municipio,
                $info->municipio->provincia->provincia,
                '',
                $info->user->email
            ];

            // Añadir la fila de datos al archivo
            $stream->addRow($dataRow);

            // Enviar el archivo al navegador para su descarga
            return $stream->toBrowser();
        } catch (\Exception $e) {
            Log::error('Error generando el archivo Excel: ' . $e->getMessage());
            toastr()->error('¡Error generando el archivo Excel!', 'Error');;
        }
    }

    // Excel para Menores Extras y Actores
    public function exportExcelYounger($modelType, $info)
    {
        try {
            // Obtengo el nombre completo del modelo basado en $modelType
            $modelClassName = 'App\Models\\' . $modelType;
            // Traigo los datos según el modelo
            $info = $modelClassName::find($info);

            if (!$info) {
                Log::error('No hay datos: ' . $info->id);
                toastr()->error('¡No hay datos seleccionados!', 'Error');
                return redirect()->back()->withInput();
            }
            // dd($info->user->parents->formattedPhone);
            // Crear un escritor de SimpleExcel
            $stream = SimpleExcelWriter::streamDownload($info->full_name . '.xlsx');

            $writer = $stream->getWriter();

            // Set the name of the current sheet to 'Datos'
            $nameSheet = $writer->getCurrentSheet();
            $nameSheet->setName('Datos');

            // Definir el estilo de la cabecera
            $headerStyle = (new Style())
                ->setFontBold()
                ->setFontSize(12)
                ->setFontColor(Color::WHITE)
                ->setBackgroundColor(Color::LIGHT_BLUE)
                ->setCellAlignment(CellAlignment::CENTER);

            // Crear la fila de la cabecera con el estilo
            $headerRow = Row::fromValues([
                'Nombre', 'Apellidos', 'N. Artístico', 'Tel. Padres', 'DNI/NIE', 'SegSoc', 'Fec. Nac.', 'Calle', 'Municipio', 'Provincia', 'Nº Cuenta', 'Email Padres'
            ], $headerStyle);

            $stream->addRow($headerRow);

            // Formatear la fecha de nacimiento
            $age = Carbon::createFromFormat('Y-m-d', $info->birthdate)->format('d-m-Y');

            // Crear la fila de datos
            $dataRow = [
                ucwords($info->name),
                ucwords($info->first_lname . ' ' . $info->second_lname),
                ucwords($info->formattedAlias),
                $info->user->parents->formattedPhone ?? $info->formattdPhone,
                $info->formattedDni,
                $info->ss,
                $age,
                $info->adress,
                $info->municipio->municipio,
                $info->municipio->provincia->provincia,
                '',
                $info->user->parents->email ?? $info->user->email
            ];

            // Añadir la fila de datos al archivo
            $stream->addRow($dataRow);

            // Enviar el archivo al navegador para su descarga
            return $stream->toBrowser();
        } catch (\Exception $e) {
            Log::error('Error generando el archivo Excel: ' . $e->getMessage());
            toastr()->error('¡Error generando el archivo Excel!', 'Error');;
        }
    }

    // Excel para Coordinadores
    public function exportExcelCoordinator($modelType, $info)
    {
        try {
            // Obtengo el nombre completo del modelo basado en $modelType
            $modelClassName = 'App\Models\\' . $modelType;
            // Traigo los datos según el modelo
            $info = $modelClassName::find($info);

            if (!$info) {
                Log::error('No hay datos: ' . $info->id);
                toastr()->error('¡No hay datos seleccionados!', 'Error');
                return redirect()->back()->withInput();
            }

            // Crear un escritor de SimpleExcel
            $stream = SimpleExcelWriter::streamDownload($info->full_name . '.xlsx');

            $writer = $stream->getWriter();

            // Set the name of the current sheet to 'Datos'
            $nameSheet = $writer->getCurrentSheet();
            $nameSheet->setName('Datos');

            // Definir el estilo de la cabecera
            $headerStyle = (new Style())
                ->setFontBold()
                ->setFontSize(12)
                ->setFontColor(Color::WHITE)
                ->setBackgroundColor(Color::LIGHT_BLUE)
                ->setCellAlignment(CellAlignment::CENTER);

            // Crear la fila de la cabecera con el estilo
            $headerRow = Row::fromValues([
                'Nombre', 'Apellidos', 'Tel.', 'DNI/NIE', 'SegSoc', 'Fec. Nac.', 'Calle', 'Municipio', 'Provincia', 'Nº Cuenta', 'Email'
            ], $headerStyle);

            $stream->addRow($headerRow);

            // Formatear la fecha de nacimiento
            $age = Carbon::createFromFormat('Y-m-d', $info->birthdate)->format('d-m-Y');

            // Crear la fila de datos
            $dataRow = [
                ucwords($info->name),
                ucwords($info->first_lname . ' ' . $info->second_lname),
                $info->formattedPhone,
                $info->formattedDni,
                $info->ss,
                $age,
                $info->adress,
                $info->municipio->municipio,
                $info->municipio->provincia->provincia,
                '',
                $info->user->email
            ];

            // Añadir la fila de datos al archivo
            $stream->addRow($dataRow);

            // Enviar el archivo al navegador para su descarga
            return $stream->toBrowser();
        } catch (\Exception $e) {
            Log::error('Error generando el archivo Excel: ' . $e->getMessage());
            toastr()->error('¡Error generando el archivo Excel!', 'Error');;
        }
    }

    public function exportPdf($modelType, $info)
    {
        // Obtengo el nombre completo del modelo basado en $modelType
        $modelClassName = 'App\Models\\' . $modelType;

        // traigo los datos segun modelo
        $info = $modelClassName::find($info);
        // dd($info);
        $info->age = Carbon::parse($info->birthdate)->age;

        if ($modelType === 'Xtra') {
            // $url = 'https://smartfiguracion.es/public/images/extras/';
            $url = getImagePath('/extras/');
        }

        if ($modelType === 'Actor') {
            // $url = 'https://smartfiguracion.es/public/images/actors/';
            $url = getImagePath('/actors/');
        }

        $pdf = Pdf::loadView('exports.pdf', ['info' => $info, 'url' => $url]);
        return $pdf->download($info->full_name . '.pdf');
    }

    public function exportPdfYounger($modelType, $info)
    {
        // Obtengo el nombre completo del modelo basado en $modelType
        $modelClassName = 'App\Models\\' . $modelType;

        // traigo los datos segun modelo
        $info = $modelClassName::find($info);
        // dd($info);
        $info->age = Carbon::parse($info->birthdate)->age;

        if ($modelType === 'Xtra') {
            // $url = 'https://smartfiguracion.es/public/images/extras/';
            $url = getImagePath('/extras/');
        }

        if ($modelType === 'Actor') {
            // $url = 'https://smartfiguracion.es/public/images/actors/';
            $url = getImagePath('/actors/');
        }

        $pdf = Pdf::loadView('exports.pdfYounger', ['info' => $info, 'url' => $url]);
        return $pdf->download($info->full_name . '.pdf');
    }

    public function exportPdfcoordinator($modelType, $info)
    {
        // Obtengo el nombre completo del modelo basado en $modelType
        $modelClassName = 'App\Models\\' . $modelType;

        // traigo los datos segun modelo
        $info = $modelClassName::find($info);
        // dd($info);
        $info->age = Carbon::parse($info->birthdate)->age;

        $urlImage = getImagePath('/coordinators/');
        $urlFile = getFilePath('/coordinators/');

        $pdf = Pdf::loadView('exports.pdfCoordinator', ['info' => $info, 'image' => $urlImage, 'file' => $urlFile]);
        return $pdf->download($info->full_name . '.pdf');
    }


    public function excelViewers(Event $data)
    {
        try {
            $viewers = Viewer::whereRelation('events', [
                'is_selected' => true,
                'event_id' => $data->id
            ])->get();

            // Verificar si hay espectadore
            if ($viewers->isEmpty()) {
                Log::error('No hay Espectadores seleccionados para el evento: ' . $data->id);
                toastr()->error('¡No hay Espectadores seleccionados!', 'Error');
                return redirect()->back()->withInput();
            }

            // Inicia el proceso de creación del archivo Excel
            $stream = SimpleExcelWriter::streamDownload('Espectadores_' . $data->name . '.xlsx');

            // Generar un nombre de hoja válido (no más de 31 caracteres)
            $sheetName = 'Seleccionados ' . $data->name;
            if (strlen($sheetName) > 31) {
                $sheetName = substr($sheetName, 0, 31);
            }

            // Establecer el nombre de la hoja
            $writer = $stream->getWriter();
            $writer->getCurrentSheet()->setName($sheetName);

            // Agregar las filas al archivo Excel
            foreach ($viewers as $viewer) {
                $stream->addRow([
                    'Nombre' => ucwords($viewer->name),
                    'Provincia' => $viewer->provincia->provincia,
                    'Email' => $viewer->email,
                    'Teléfono' => $viewer->phone,
                    'Género' => $viewer->gender,
                    'Edad' => $viewer->age,
                ]);
            }

            toastr()->success('¡Excel creado!', 'Éxito');
            // Enviar el archivo al navegador para su descarga
            return $stream->toBrowser();
        } catch (\Exception $e) {
            Log::error('Error generando el archivo Excel: ' . $e->getMessage());
            toastr()->error('¡Error generando el archivo Excel!', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
