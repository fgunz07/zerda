<?php

namespace App\Services;
use App\User;

class RatingService
{
    public function projectRate() 
    {
        $totalPoints = (count(auth()->user()->completed) + auth()->user()->rl) * 10;

        if($totalPoints > 0) {

            $totalPercentage = ((count(auth()->user()->completed) + auth()->user()->rl) / $totalPoints * 30) * 10;

            $totalCurrentPoints = $totalPoints - (auth()->user()->rl * 10);

            $total = ($totalCurrentPoints / $totalPoints) * $totalPercentage;

            $user = User::findOrFail(auth()->user()->id);
            $user->avg_projects = $total;
            $user->save();
        
        }
    }

    public function userRate($id) 
    {
        $user = User::findOrFail($id);
        
        $totalRate = $user->total_rate / $user->number_rate * 10 * 25;

        $user->avg_user_rate = $totalRate;
        $user->save();
    }

    public function skillRate()
    {
        $totalPercentage = null;

        $shouldBe = 5 * 10;

        $totalSkillPoints = count(auth()->user()->skills) * 10;

        $total = count(auth()->user()->skills) > 5 ? 15 : $totalSkillPoints / $shouldBe * 15;

        $user       = User::findOrFail(auth()->user()->id);
        $user->avg_skills = $total;
        $user->save(); 
    }

    public function ongoingRate() {

        $total = count(auth()->user()->ongoing) * 10;
        
        $totalPercentage = 5 * 10;

        $user = User::findOrFail(auth()->user()->id);

        $percentage =  count(auth()->user()->ongoing) / $totalPercentage * 10;

        $user->avg_ongoing = count(auth()->user()->ongoing) > 5 ? '10' : $percentage;
        $user->save();

    }

    public function hrRate() {

        $maxHr = 100;
        // $maxAday = $maxHr * 8;
        // $totalPercentage = ((22 * 8) / $maxAday) * 20;

        $totalPercentage = auth()->user()->hourly > $maxHr ? 0 : 20;
        $user = User::findOrFail(auth()->user()->id);
        $user->avg_hr = $totalPercentage;
        $user->save();

    }

    public function totalAvg()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->rate = $user->avg_projects + $user->avg_user_rate + $user->avg_skills + $user->avg_ongoing + $user->avg_hr;
        $user->save();
    }
}