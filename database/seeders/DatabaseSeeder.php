<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gawa tayo ng test user para makapag-login ka
        User::factory()->create([
            'name' => 'F1 Fan',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Ang official 2026 F1 Grid
        $grid2026 = [
            'McLaren' => ['Lando Norris', 'Oscar Piastri'],
            'Ferrari' => ['Charles Leclerc', 'Lewis Hamilton'],
            'Red Bull Racing' => ['Max Verstappen', 'Isack Hadjar'],
            'Mercedes' => ['George Russell', 'Kimi Antonelli'],
            'Aston Martin' => ['Fernando Alonso', 'Lance Stroll'],
            'Alpine' => ['Pierre Gasly', 'Franco Colapinto'],
            'Haas' => ['Esteban Ocon', 'Oliver Bearman'],
            'Racing Bulls' => ['Liam Lawson', 'Arvid Lindblad'],
            'Williams' => ['Carlos Sainz', 'Alex Albon'],
            'Audi' => ['Nico Hülkenberg', 'Gabriel Bortoleto'],
            'Cadillac' => ['Sergio Pérez', 'Valtteri Bottas'],
        ];

        foreach ($grid2026 as $teamName => $drivers) {
            $team = Team::create([
                'name' => $teamName,
                'livery_image_path' => 'liveries/' . strtolower(str_replace(' ', '_', $teamName)) . '.jpg'
            ]);

            foreach ($drivers as $driverName) {
                $team->drivers()->create(['name' => $driverName]);
            }
        }
    }
}
