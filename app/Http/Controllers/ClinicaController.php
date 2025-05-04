<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinica;
use App\Models\ImagenClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ClinicaController extends Controller
{
    /**
     * Muestra el formulario para editar la información de la clínica.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        $clinica = Clinica::with('imagenes')->firstOrFail(); // Asumiendo que solo hay una entrada de clínica
        return view('admin.clinica.edit', compact('clinica'));
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

        return redirect()->route('admin.clinica.edit')->with('success', 'Información de la clínica actualizada correctamente.');
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
        $path = $request->file('imagen')->store('public/clinica/carousel'); // Guarda la imagen en storage/app/public/clinica/carousel
        $url = Storage::url($path); // Obtiene la URL pública de la imagen

        ImagenClinica::create([
            'id_clinica' => $clinica->id_clinica,
            'url_imagen' => $url,
        ]);

        return redirect()->route('admin.clinica.edit')->with('success', 'Imagen del carrusel añadida correctamente.');
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

        return redirect()->route('admin.clinica.edit')->with('success', 'Imagen del carrusel eliminada correctamente.');
    }
}