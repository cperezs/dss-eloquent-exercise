<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Player;
use App\Models\Sponsor;
use App\Models\Team;

class AssociationsTest extends TestCase
{
    /**
     * Checks the association Sponsor-Team
     *
     * @return void
     */
    public function testAssociationSponsorTeam()
    {
        $sponsor = new Sponsor();
        $sponsor->name = 'Nvidia';
        $sponsor->save();

        $team = new Team();
        $team->name = 'Morning Singers';
        $sponsor->teams()->save($team);

        $this->assertEquals($team->sponsor->name, 'Nvidia');
        $this->assertEquals($sponsor->teams[0]->name, 'Morning Singers');
        
        $team->delete();
        $sponsor->delete();
    }

    /**
     * Checks the association Team-Player
     *
     * @return void
     */
    public function testAssociationTeamPlayer()
    {
        $sponsor = new Sponsor();
        $sponsor->name = 'Nvidia';
        $sponsor->save();

        $team = new Team();
        $team->name = 'Morning Singers';
        $team->sponsor()->associate($sponsor);
        $team->save();

        $player = new Player();
        $player->name = 'Billy Jean';
        $player->age = 20;
        $player->save();
        $player->teams()->attach($team->id);

        $this->assertEquals($team->players[0]->name, 'Billy Jean');
        $this->assertEquals($player->teams[0]->name, 'Morning Singers');

        $player->teams()->detach($team->id);
        $player->delete();
        $team->delete();
        $sponsor->delete();
    }

}
