<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ArchivoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Organismo;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\URL;

class ArchivoController extends Controller
{

    public function index(Request $request)
    {
        $urlActual = $request->fullUrl();
        session(['ultima_url' => $urlActual]);

        $organismo_id = $request->get('organismo_id');
        $archivos = Archivo::paginate();

        if ($organismo_id == 1) {
            $archivos = Archivo::paginate(10);
        } else {
            $archivos = Archivo::where('organismo_id', $organismo_id)->paginate(10);
        }

        return view('archivos.index', compact('archivos'))
        ->with('i', ($request->input('page', 1) - 1) * $archivos->perPage());
    }

    public function create(Request $request): View
    {
        $organismoId = $request->query('organismo_id');

        // Define los organismos permitidos para cada organismo_id
        $organismosPermitidos = [
            1 => ['Policia de la Ciudad', 'Bomberos de la Ciudad', 'Defensa Civil'],
            2 => ['Policia de la Ciudad'],
            3 => ['Bomberos de la Ciudad'],
            4 => ['Defensa Civil'],
        ];

        // Filtrar los organismos por nombre según el organismo_id
        $organismos = Organismo::when($organismoId, function ($query) use ($organismoId, $organismosPermitidos) {
            if (isset($organismosPermitidos[$organismoId])) {
                $query->whereIn('nombre', $organismosPermitidos[$organismoId]);
            }
        })->get();

        //dd($organismoId);

        $archivo = new Archivo();
        return view('archivos.create', compact('archivo', 'organismos', 'organismoId'));
    }

    public function show($id, Request $request): View
    {
        $organismoId = $request->query('organismo_id');

        $organismosPermitidos = [
            1 => ['Policia de la Ciudad', 'Bomberos de la Ciudad', 'Defensa Civil'],
            2 => ['Policia de la Ciudad'],
            3 => ['Bomberos de la Ciudad'],
            4 => ['Defensa Civil'],
        ];

        $organismos = Organismo::when($organismoId, function ($query) use ($organismoId, $organismosPermitidos) {
            if (isset($organismosPermitidos[$organismoId])) {
                $query->whereIn('nombre', $organismosPermitidos[$organismoId]);
            }
        })->get();

        $archivo = Archivo::find($id);
        return view('archivos.show', compact('archivo', 'organismos'));
    }

    public function edit($id, Request $request): View
    {
        $organismoId = $request->query('organismo_id');

        $organismosPermitidos = [
            1 => ['Policia de la Ciudad', 'Bomberos de la Ciudad', 'Defensa Civil'],
            2 => ['Policia de la Ciudad'],
            3 => ['Bomberos de la Ciudad'],
            4 => ['Defensa Civil'],
        ];

        $organismos = Organismo::when($organismoId, function ($query) use ($organismoId, $organismosPermitidos) {
            if (isset($organismosPermitidos[$organismoId])) {
                $query->whereIn('nombre', $organismosPermitidos[$organismoId]);
            }
        })->get();

        $archivo = Archivo::find($id);
        return view('archivos.edit', compact('archivo', 'organismos','organismoId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organismo_id' => 'required|integer|in:2,3,4',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Captura el nombre original del archivo
        $nombreOriginal = $request->file('archivo')->getClientOriginalName();

        // Genera una ruta única para evitar colisiones de archivos con el mismo nombre
        $nombreLimpio = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreOriginal);

        // Guarda el archivo en el almacenamiento con su nombre original (limpio) y obtiene la ruta completa
        $archivoPath = $request->file('archivo')->storeAs('archivos', $nombreLimpio, 'public');

        // Guarda el registro en la base de datos, almacenando tanto el nombre original como la ruta en el sistema
        Archivo::create([
            'organismo_id' => $request->organismo_id,
            'descripcion' => $request->descripcion,
            'archivo' => $archivoPath, // Guarda la ruta generada para acceder al archivo
            'nombre_original' => $nombreOriginal, // Guarda el nombre original en la base de datos
        ]);

        $redirectUrl = session('ultima_url', route('archivos.index'));
        return redirect($redirectUrl)->with('success', 'Archivo guardado exitosamente');

        //return (URL::previous());
    }

    public function update(Request $request, Archivo $archivo)
    {
        $nombreOriginal = $request->file('archivo')->getClientOriginalName();

        // Captura el nombre original si se proporciona un nuevo archivo
        if ($request->hasFile('archivo')) {
            $nombreOriginal = $request->file('archivo')->getClientOriginalName();
            $nombreLimpio = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreOriginal);

            // Elimina el archivo anterior si existe en el almacenamiento
            if ($archivo->archivo && Storage::disk('public')->exists($archivo->archivo)) {
                Storage::disk('public')->delete($archivo->archivo);
            }

            // Guarda el nuevo archivo y obtiene la nueva ruta
            $archivoPath = $request->file('archivo')->storeAs('archivos', $nombreLimpio, 'public');

            // Actualiza los campos relacionados con el archivo
            $archivo->archivo = $archivoPath;
            $archivo->nombre_original = $nombreOriginal;
        }

        // Actualiza otros campos
        $archivo->organismo_id = $request->organismo_id;
        $archivo->descripcion = $request->descripcion;
        $archivo->save();

        // Redirige a la página anterior con el parámetro organismo_id
        $redirectUrl = session('ultima_url', route('archivos.index'));
        return redirect($redirectUrl)->with('success', 'Archivo actualizado exitosamente');

        //return redirect(URL::previous())->with('success', 'Archivo guardado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        $archivo = Archivo::findOrFail($id);

        if ($archivo->archivo && Storage::disk('public')->exists($archivo->archivo)) {
            Storage::disk('public')->delete($archivo->archivo);
        }

        $archivo->delete();

        // return Redirect::route('archivos.index')
        //     ->with('success', 'Archivo borrado exitosamente');

        $redirectUrl = session('ultima_url', route('archivos.index'));
        return redirect($redirectUrl)->with('success', 'Archivo borrado exitosamente');
    }
}
