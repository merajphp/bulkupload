<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Jobs\ImportContactsJob;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderby('id','desc')->paginate(20);
        return view('contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        Contact::create($request->all());
        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('xml_file');
        if ($file){
            $directory = storage_path('app/xml_uploads');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $filename = uniqid() . '.xml';
            $file->move($directory, $filename);
            ImportContactsJob::dispatch($directory . '/' . $filename);
            return back()->with('message', 'Import started.');
        }
    
        return back()->with('error', 'file not uploaded');
    }
    

}
