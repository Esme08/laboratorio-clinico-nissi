<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Models\ImagenClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicaController extends Controller
{
    /**
     * Muestra el formulario para editar la información de la clínica e imágenes.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {

        $clinica = Clinica::with('imagenes')->first();
        if (!$clinica) {
            $clinica = new Clinica();
            $clinica->imagenes = collect();
        }
        return view('admin.edit', compact('clinica'));
    }

    public function saveInfoClinica(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion_google_maps' => 'nullable|string|url',
            'contacto' => 'nullable|string|max:255',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // dd ($request->all());
        $requestClinica = $request->except('imagenes');
        $clinica = Clinica::first();
        if ($clinica) {
            $clinica->update($requestClinica);
        } else {
            $clinica = Clinica::create($requestClinica);
        }

        if($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('clinica/carousel', 'public');
                $url = Storage::url($path);

                ImagenClinica::create([
                    'id_clinica' => $clinica->id_clinica,
                    'url_imagen' => $url,
                ]);
            }
        }
        return redirect()->route('clinica.info')->with('success', 'Información de la clínica actualizada correctamente.');
    }

    /**
     * Actualiza la información principal de la clínica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion_google_maps' => 'nullable|string|url',
            'contacto' => 'nullable|string|max:255',
        ]);

        $clinica = Clinica::firstOrFail();
        $clinica->update($request->all());

        return redirect()->route('admin.clinica.editar')->with('success', 'Información de la clínica actualizada correctamente.');
    }

    /**
     * Almacena una nueva imagen para el carrusel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida que sea una imagen
        ]);

        $clinica = Clinica::firstOrFail();
        $path = $request->file('imagen')->store('public/clinica/carousel'); // Guarda la imagen
        $url = Storage::url($path); // Obtiene la URL pública

        ImagenClinica::create([
            'id_clinica' => $clinica->id_clinica,
            'url_imagen' => $url,
        ]);

        return redirect()->route('admin.clinica.editar')->with('success', 'Imagen del carrusel añadida correctamente.');
    }

    /**
     * Elimina una imagen del carrusel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyImagen($id)
    {
        $imagen = ImagenClinica::findOrFail($id);

        // Eliminar el archivo del storage
        $path = str_replace('/storage', 'public', $imagen->url_imagen);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $imagen->delete();

        return redirect()->route('admin.clinica.editar')->with('success', 'Imagen del carrusel eliminada correctamente.');
    }
}
