<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));
    }
}
