<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{
    public function calculate(Program $program): string
    {
        $totalDuration = 0;
        $seasons = $program->getSeasons();
        foreach ($seasons as $season) {
            $episodes = $season->getEpisodes();
            foreach ($episodes as $episode) {
                $duration = $episode->getDuration();
                $totalDuration = $totalDuration + $duration;
            }
        }
        $days = intdiv($totalDuration, 1440);
        $hours = intdiv($totalDuration - (1440 * $days), 60);
        $minutes = $totalDuration - (1440 * $days) - (60 * $hours);

        if ($days == 0) {
            if ($hours == 0) {
                if ($minutes == 0) {
                    $programDuration = 'La durée totale de visionnage de cette série est nulle : la durée des épisodes est-elle bien renseignée ?';
                } else {
                    $programDuration = 'La durée totale de visionnage de cette série est de ' . $minutes . ' minute(s).';
                }
            } elseif ($minutes == 0) {
                $programDuration = 'La durée totale de visionnage de cette série est de ' . $hours . ' heure(s).';
            } else {
                $programDuration = 'La durée totale de visionnage de cette série est de ' . $hours . ' heure(s) et ' . $minutes . ' minute(s).';
            }
        } elseif ($hours == 0) {
            if ($minutes == 0) {
                $programDuration = 'La durée totale de visionnage de cette série est de exactement ' . $days . ' jour(s).';
            } else {
                $programDuration = 'La durée totale de visionnage de cette série est de ' . $days . ' jour(s) et ' . $minutes . ' minute(s).';
            }
        } elseif ($minutes == 0) {
            $programDuration = 'La durée totale de visionnage de cette série est de ' . $days . ' jour(s) et ' . $hours . ' heure(s).';
        } else {
            $programDuration = 'La durée totale de visionnage de cette série est de ' . $days . ' jour(s), ' . $hours . ' heure(s), et ' . $minutes . ' minute(s).';
        }
        return $programDuration;
    }
}
