<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        return view('report.reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = new Report();
        $report->date = $request->date;
        $report->name = $request->name;
        $report->note = $request->note;
        
        if ($request->type == "1"){
            $report->type = "Недельный отчет";
            // Добавление пути к файлу в бд
            $path = Storage::putFile('public/week', $request->file('report'));
            $url = Storage::url($path);
            $report->file = $url;
        }
        else {
            $report->type = "Бухгалтерский отчет";
            // Добавление пути к файлу в бд
            $path = Storage::putFile('public/accountant', $request->file('report'));
            $url = Storage::url($path);
            $report->file = $url;
        }

        $report->save();
        return redirect()->route('reports.index')->with('success', 'Отчет ' . $report->name . ' успешно добавлен!');
    }

    public function download($id) {
        $report = Report::find($id);
        $path = public_path($report->file);
        return response()->download($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        return view('report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->date = $request->date;
        $report->name = $request->name;
        $report->note = $request->note;
        $request->type == "1" ? $report->type = "Недельный отчет" : $report->type = "Бухгалтерский отчет";
        
        if ($request->file('report')) {
            if ($request->type == "1"){
                // Добавление пути к файлу в бд
                $path = Storage::putFile('public/week', $request->file('report'));
                $url = Storage::url($path);
                $report->file = $url;
            }
            else {
                // Добавление пути к файлу в бд
                $path = Storage::putFile('public/accountant', $request->file('report'));
                $url = Storage::url($path);
                $report->file = $url;
            }
        }

        $report->update();
        return redirect()->route('reports.index')->with('success', 'Отчет ' . $report->name . ' успешно отредактирвоан!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $path = public_path($report->file);
        unlink($path);
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Отчет ' . $report->name . ' успешно удален!');
    }
}
