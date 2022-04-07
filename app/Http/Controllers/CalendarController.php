<?php

namespace App\Http\Controllers;
use App\Models\ScheduleEvent;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendar = ScheduleEvent::all();
        $calendar_json = json_encode($calendar);
        return view('calendar.calendar', compact('calendar_json'));
    }

    public function store(Request $request)
    {
        $calendar = new ScheduleEvent();
        $calendar->title = $request->title;
        $calendar->description = $request->description;
        $calendar->start = $request->dateBegin;
        $calendar->end = $request->dateEnd;

        $calendar->save();
        // return redirect()->route('calendar.index');
    }

    public function edit($id)
    {
        $calendar = ScheduleEvent::find($id);
        echo $calendar; 
        // return view('report.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $calendar = ScheduleEvent::find($id);
        $calendar->title = $request->title_edit;
        $calendar->description = $request->description_edit;
        $calendar->start = $request->date_begin;
        $calendar->end = date("Y-m-d", strtotime("+1 days", strtotime($request->date_end)));
        // $calendar->end = $request->date_end;

        $calendar->update();
        return redirect()->route('calendar.index')->with('success', 'Событие ' . $calendar->title . ' успешно отредактировано!');
    }

    public function destroy($id)
    {
        $calendar = ScheduleEvent::find($id);
        $calendar->delete();
        return redirect()->route('calendar.index')->with('success', 'Событие ' . $calendar->title . ' успешно удален!');
    }
}
