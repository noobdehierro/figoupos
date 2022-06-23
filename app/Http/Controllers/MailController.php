<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $mails = Mail::sortable()->paginate(5);

        return view('adminhtml.mails.index', ['mails' => $mails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $brands = Brand::select('id', 'name')->get();
        return view('adminhtml.mails.create', ['brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = $this->validateMail();

        $attributes['driver'] = 'smtp';

        try {
             Mail::create($attributes);
            return redirect()->route('mails.index')->with('success', 'Mail created successfully');
        } catch (\Exception $e) {
            return redirect()->route('mails.index')->with('error', 'Mail not created');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        return $this->edit($mail);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        $brands = Brand::select('id', 'name')->get();

        return view('adminhtml.mails.edit', ['mail' => $mail, 'brands' => $brands]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        $attributes = $this->validateMail($mail);

        try {
            $mail->update($attributes);
            return redirect()->route('mails.index')->with('success', 'Mail updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('mails.index')->with('error', 'Mail not updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        try {
            $mail->delete();
            return redirect()->route('mails.index')->with('success', 'Mail deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('mails.index')->with('error', 'Mail not deleted');
        }

    }

    protected function validateMail(?Mail $mail = null): array
    {
        $mail = $mail ?? new Mail();

        return request()->validate([
            'description' => 'required',
            'brand_id' => 'required | unique:mails,brand_id,' . $mail->id,
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'required',
            'from_address' => 'required',
            'from_name' => 'required',
        ], [
            'brand_id.unique' => 'Esta marca ya tiene un correo configurado',
        ]);

    }
}
