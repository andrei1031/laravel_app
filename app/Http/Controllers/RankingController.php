<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Dito ang magic: Kukunin ang teams at isasaayos base sa saved ranking ng current user
        $teams = Team::with('drivers')
            ->leftJoin('rankings', function ($join) use ($userId) {
                $join->on('teams.id', '=', 'rankings.team_id')
                    ->where('rankings.user_id', '=', $userId);
            })
            // I-sort mula Rank 1 pababa. Kung walang rank (bagong user), ibabato sa ilalim.
            ->orderByRaw('CASE WHEN rankings.rank_position IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rankings.rank_position', 'asc')
            ->orderBy('teams.id', 'asc')
            ->select('teams.*') // Para hindi ma-overwrite ang team ID ng ranking ID
            ->get();

        $teamColors = [
            'McLaren' => '#FF8000',
            'Ferrari' => '#E8002D',
            'Red Bull Racing' => '#3671C6',
            'Mercedes' => '#27F4D2',
            'Aston Martin' => '#229971',
            'Alpine' => '#FF87BC',
            'Haas' => '#EAEAEA',
            'Racing Bulls' => '#6692FF',
            'Williams' => '#00A0DE',
            'Audi' => '#E2001A',
            'Cadillac' => '#D4AF37',
        ];

        $driverStats = [
            'Lando Norris' => ['num' => '4', 'champ' => '0', 'wins' => '3+', 'podiums' => '25+', 'poles' => '3+', 'fastLaps' => '8+'],
            'Oscar Piastri' => ['num' => '81', 'champ' => '0', 'wins' => '2+', 'podiums' => '12+', 'poles' => '0+', 'fastLaps' => '2+'],
            'Charles Leclerc' => ['num' => '16', 'champ' => '0', 'wins' => '7+', 'podiums' => '35+', 'poles' => '23+', 'fastLaps' => '10+'],
            'Lewis Hamilton' => ['num' => '44', 'champ' => '7', 'wins' => '105+', 'podiums' => '197+', 'poles' => '104+', 'fastLaps' => '66+'],
            'Max Verstappen' => ['num' => '1', 'champ' => '3+', 'wins' => '60+', 'podiums' => '105+', 'poles' => '39+', 'fastLaps' => '33+'],
            'Isack Hadjar' => ['num' => '30', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            // Add all other drivers...
            'George Russell' => ['num' => '63', 'champ' => '0', 'wins' => '2+', 'podiums' => '15+', 'poles' => '2+', 'fastLaps' => '7+'],
            'Kimi Antonelli' => ['num' => '12', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Fernando Alonso' => ['num' => '14', 'champ' => '2', 'wins' => '32+', 'podiums' => '106+', 'poles' => '22', 'fastLaps' => '24'],
            'Lance Stroll' => ['num' => '18', 'champ' => '0', 'wins' => '0', 'podiums' => '3', 'poles' => '1', 'fastLaps' => '0'],
            'Pierre Gasly' => ['num' => '10', 'champ' => '0', 'wins' => '1+', 'podiums' => '4+', 'poles' => '0', 'fastLaps' => '3+'],
            'Franco Colapinto' => ['num' => '43', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Esteban Ocon' => ['num' => '31', 'champ' => '0', 'wins' => '1+', 'podiums' => '3+', 'poles' => '0', 'fastLaps' => '0'],
            'Oliver Bearman' => ['num' => '87', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Liam Lawson' => ['num' => '30', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Arvid Lindblad' => ['num' => '?', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Carlos Sainz' => ['num' => '55', 'champ' => '0', 'wins' => '3+', 'podiums' => '20+', 'poles' => '5+', 'fastLaps' => '3+'],
            'Alex Albon' => ['num' => '23', 'champ' => '0', 'wins' => '0', 'podiums' => '2', 'poles' => '0', 'fastLaps' => '0'],
            'Nico Hülkenberg' => ['num' => '27', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '1', 'fastLaps' => '2'],
            'Gabriel Bortoleto' => ['num' => '?', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'],
            'Sergio Pérez' => ['num' => '11', 'champ' => '0', 'wins' => '6+', 'podiums' => '35+', 'poles' => '3+', 'fastLaps' => '11+'],
            'Valtteri Bottas' => ['num' => '77', 'champ' => '0', 'wins' => '10', 'podiums' => '67', 'poles' => '20', 'fastLaps' => '19'],
        ];

        $teamData = [];
        foreach ($teams as $team) {
            $color = $teamColors[$team->name] ?? '#888888';
            $driversData = [];
            foreach ($team->drivers as $driver) {
                $stats = $driverStats[$driver->name] ?? ['num' => '?', 'champ' => '0', 'wins' => '0', 'podiums' => '0', 'poles' => '0', 'fastLaps' => '0'];
                $driversData[] = array_merge(['name' => $driver->name], $stats);
            }
            $teamData[$team->name] = [
                'livery_path' => $team->livery_image_path,
                'color' => $color,
                'drivers' => $driversData
            ];
        }

        return view('rankings.index', compact('teams', 'teamData'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        // Cleanup old rankings first
        Ranking::where('user_id', $userId)->delete();

        $rankings = $request->input('rankings'); // Listahan ng IDs na naka-arrange na

        foreach ($rankings as $index => $teamId) {
            // I-save ang rank position sa database
            Ranking::create([
                'user_id' => $userId,
                'team_id' => $teamId,
                'rank_position' => $index + 1
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function reset(Request $request)
    {
        $userId = Auth::id();
        Ranking::where('user_id', $userId)->delete();
        return response()->json(['status' => 'success']);
    }
}
