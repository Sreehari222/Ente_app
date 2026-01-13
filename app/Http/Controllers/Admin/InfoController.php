<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\EmergencyContact;
use App\Models\Announcement;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    // ----------------- Notices -----------------
    public function notices()
    {
        $notices = Notice::latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function storeNotice(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'area'=>'required|string',
            'description'=>'required|string',
        ]);
        Notice::create($request->all());
        return back()->with('success','Notice added successfully');
    }

    public function editNotice($id)
    {
        $notice = Notice::findOrFail($id);
        return view('admin.notices.edit', compact('notice'));
    }

    public function updateNotice(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|string',
            'area'=>'required|string',
            'description'=>'required|string',
        ]);
        Notice::findOrFail($id)->update($request->all());
        return redirect()->route('admin.notices.index')->with('success','Notice updated successfully');
    }

    public function destroyNotice($id)
    {
        Notice::findOrFail($id)->delete();
        return back()->with('success','Notice deleted successfully');
    }

    // ----------------- Emergency Contacts -----------------
    public function contacts()
    {
        $contacts = EmergencyContact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'contact_number'=>'required|string',
            'area'=>'required|string',
            'description'=>'nullable|string',
        ]);
        EmergencyContact::create($request->all());
        return back()->with('success','Contact added successfully');
    }

    public function editContact($id)
    {
        $contact = EmergencyContact::findOrFail($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'contact_number'=>'required|string',
            'area'=>'required|string',
            'description'=>'nullable|string',
        ]);
        EmergencyContact::findOrFail($id)->update($request->all());
        return redirect()->route('admin.contacts.index')->with('success','Contact updated successfully');
    }

    public function destroyContact($id)
    {
        EmergencyContact::findOrFail($id)->delete();
        return back()->with('success','Contact deleted successfully');
    }

    // ----------------- Announcements -----------------
    public function announcements()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'area'=>'required|string',
            'description'=>'required|string',
        ]);
        Announcement::create($request->all());
        return back()->with('success','Announcement added successfully');
    }

    public function editAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|string',
            'area'=>'required|string',
            'description'=>'required|string',
        ]);
        Announcement::findOrFail($id)->update($request->all());
        return redirect()->route('admin.announcements.index')->with('success','Announcement updated successfully');
    }

    public function destroyAnnouncement($id)
    {
        Announcement::findOrFail($id)->delete();
        return back()->with('success','Announcement deleted successfully');
    }
}
