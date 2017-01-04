<?php

namespace App\Http\Controllers\Admin;

use App\Contest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = Contest::all();

        return view('BO.html.pages.contests.index', [
            'contests' => $contests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BO.html.pages.contests.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'label' => 'required',
            'description' => 'required',
            'reward' => 'required',
            'beginAt' => 'required|date|different:endAt|after:today',
            'endAt' => 'required|date|different:beginAt|after:beginAt',
            'cover' => 'image'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.contests.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $beginAt = Date::parse($request->beginAt);
            $endAt = Date::parse($request->endAt)->hour(23)->minute(59)->second(59);
            //TODO: check other contest date
            $contests = Contest::all();
            foreach ($contests as $contest) {
                if ($beginAt > $contest->begin_at && $beginAt < $contest->end_at)
                    return redirect()->route('admin.contests.create')->with('error', 'Le début empiète sur un concour');
                if ($endAt > $contest->begin_at && $endAt < $contest->end_at)
                    return redirect()->route('admin.contests.create')->with('error', 'La fin empiète sur un concour');
                if($contest->begin_at > $beginAt && $contest->end_at < $endAt)
                    return redirect()->route('admin.contests.create')->with('error', 'Le concours en englobe un autre');
            }

            $contest = new Contest();

            $contest->label = $request->label;
            $contest->short = $request->short;
            $contest->description = $request->description;
            $contest->reward = $request->reward;
            $contest->begin_at = $beginAt;
            $contest->end_at = $endAt;

            if ($request->hasFile('cover') && $request->file('cover')->isValid()) {

            }

            $contest->save();

            return redirect()->route('admin.contests.index')->with('success', 'Le concours est créé');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contest = Contest::findOrFail($id);

        return view('BO.html.pages.contests.show', ['contest' => $contest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }
}
