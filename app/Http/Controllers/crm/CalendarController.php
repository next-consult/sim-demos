<?php

namespace App\Http\Controllers\crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactCrm;
use App\Models\Oportunity;
use App\Models\Reunion;
use DateTime;
use Validator;

class CalendarController extends Controller
{
    private function date_convert($date)
    {
        if ($date == "Invalid date") {
            return null;
        }
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date);
        $date_fin = $dateTime->format('D M d Y H:i:s \G\M\TO');
        return $date_fin;
    }
    public function index()
    {
        $opportunites = Oportunity::all();
        $reunions = Reunion::all();
        return view('calendars.index')
            ->with(compact('reunions'))
            ->with(compact('opportunites'));
    }

    public function add_events(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'opportunie_id' => 'required',
                'type' => 'required',
                'date' => 'required',
                'date_fin' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $dateTimestamp1 = strtotime($request->date);
        $dateTimestamp2 = strtotime($request->date_fin);
        if ($dateTimestamp1 > $dateTimestamp2) {
            return response()->json(['error_compare' => -1]);
        }
        $opp = Oportunity::find($request->opportunie_id);
        $title = $opp->titre . ' ( ' . $opp->contact->nom . ' )';

        $color = $request->type == "en_ligne" ? "#1874A2" : "#0E6655";
        Reunion::create([
            'oportunity_id' => $request->opportunie_id,
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'title' => $title,
            'start' => $this->date_convert($request->date),
            'end' => $this->date_convert($request->date_fin),
            'status' => 'en attente',
            'color' => $color
        ]);
        return response()->json(200);
    }
    public function update_drop(Request $request)
    {
        Reunion::where('id', $request->id)->update([
            'start' => $this->date_convert($request->start),
            'end' => $this->date_convert($request->end),
        ]);
        return response()->json(200);
    }
    public function one_event($id)
    {
        $reunion = Reunion::where('id', $id)->first();
        return response()->json($reunion);
    }
    public function update_events(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'opportunie_id' => 'required',
                'type' => 'required',
                'date' => 'required',
                'date_fin' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $dateTimestamp1 = strtotime($request->date);
        $dateTimestamp2 = strtotime($request->date_fin);
        if ($dateTimestamp1 > $dateTimestamp2) {
            return response()->json(['error_compare' => -1]);
        }
        $opp = Oportunity::find($request->opportunie_id);
        $title = $opp->titre . ' ( ' . $opp->contact->nom . ' )';
        $color = $request->type == "en_ligne" ? "#1874A2" : "#0E6655";

        Reunion::where('id', $request->id)->update([
            'oportunity_id' => $request->opportunie_id,
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'title' => $title,
            'start' => $this->date_convert($request->date),
            'end' => $this->date_convert($request->date_fin),
            'status' => 'en attente',
            'color' => $color

        ]);
        return response()->json(200);
    }
    public function delete_event($id)
    {
        Reunion::where('id', $id)->delete();
        return response()->json(200);
    }
}
     //convert date
        // $dateTime = DateTime::createFromFormat('D M d Y H:i:s \G\M\TO', $request->date);
        // dd($dateTime->format('Y-m-d H:i:s'));