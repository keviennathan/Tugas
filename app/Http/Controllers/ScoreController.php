<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScoreController extends Controller
{
    public function index()
    {
        $scoreA = Session::get('scoreA', 0);
        $scoreB = Session::get('scoreB', 0);
        $setA = Session::get('setA', 0);
        $setB = Session::get('setB', 0);
        $maxSet = Session::get('maxSet', 3);

        $requiredSetToWin = ceil($maxSet / 2);

        $winner = null;
        if ($setA >= $requiredSetToWin) {
            $winner = 'Player A';
        } elseif ($setB >= $requiredSetToWin) {
            $winner = 'Player B';
        }

        return view('score', compact('scoreA', 'scoreB', 'setA', 'setB', 'maxSet', 'winner'));
    }

    public function addScore($player)
    {
        $setA = Session::get('setA', 0);
        $setB = Session::get('setB', 0);
        $maxSet = Session::get('maxSet', 3);
        $requiredSetToWin = ceil($maxSet / 2);

        if ($setA >= $requiredSetToWin || $setB >= $requiredSetToWin) {
            return redirect()->route('score.index');
        }

        // Tambah skor
        if ($player === 'A') {
            Session::put('scoreA', Session::get('scoreA', 0) + 1);
        } elseif ($player === 'B') {
            Session::put('scoreB', Session::get('scoreB', 0) + 1);
        }

        $scoreA = Session::get('scoreA', 0);
        $scoreB = Session::get('scoreB', 0);

        // ✅ Aturan deuce:
        if (($scoreA >= 11 || $scoreB >= 11) && abs($scoreA - $scoreB) >= 2) {
            if ($scoreA > $scoreB) {
                Session::put('setA', $setA + 1);
            } else {
                Session::put('setB', $setB + 1);
            }

            // Reset skor
            Session::put('scoreA', 0);
            Session::put('scoreB', 0);
        }

        return redirect()->route('score.index');
    }

    public function reset()
    {
        Session::put('scoreA', 0);
        Session::put('scoreB', 0);
        Session::put('setA', 0);
        Session::put('setB', 0);
        return redirect()->route('score.index');
    }

    public function toggleSet()
    {
        $maxSet = Session::get('maxSet', 3);
        Session::put('maxSet', $maxSet == 3 ? 5 : 3);

        Session::put('scoreA', 0);
        Session::put('scoreB', 0);
        Session::put('setA', 0);
        Session::put('setB', 0);

        return redirect()->route('score.index');
    }
}
