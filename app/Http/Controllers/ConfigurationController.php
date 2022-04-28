<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configuration::paginate(25);
        return view('adminhtml.configurations.index', [
            'configurations' => $configurations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminhtml.configurations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'label' => 'required',
            'code' => ['required', 'unique:configurations'],
            'value' => 'required',
            'group' => 'required'
        ]);

        try {
            $attributes['is_protected'] = $request->is_protected == 'on';

            Configuration::create($attributes);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('configurations.index')
            ->with('success', 'Se ha añadido una configuración correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        return view('adminhtml.configurations.edit', [
            'configuration' => $configuration
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Configuration $configuration)
    {
        $attributes = $request->validate([
            'label' => 'required',
            'code' => Rule::unique('configurations', 'code')->ignore(
                $configuration->id
            ),
            'value' => 'required',
            'group' => 'nullable'
        ]);

        try {
            $configuration->update($attributes);

            return redirect()
                ->route('configurations.index')
                ->with('success', 'Ha guardado los cambios.');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Configuration $configuration)
    {
        if (!$configuration->is_protected) {
            try {
                $configuration->delete();

                return redirect()
                    ->route('configurations.index')
                    ->with('success', 'El recuso se elimino con exito.');
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            return back()->with(
                'error',
                'No se puede eliminar un recurso protegido.'
            );
        }
    }
}
