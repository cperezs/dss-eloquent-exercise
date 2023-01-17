<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Sponsor;
use App\Models\Team;
use App\Models\Player;

class DataTest extends TestCase
{
    /**
     * Checks the number and names of the sponsors
     *
     * @return void
     */
    public function testSponsorsData()
    {
        $count = Sponsor::all()->count();
        $this->assertEquals($count, 5);

        $this->assertDatabaseHas('sponsors', ['name' => 'Samsung']);
        $this->assertDatabaseHas('sponsors', ['name' => 'Toshiba']);
        $this->assertDatabaseHas('sponsors', ['name' => 'Asus']);
        $this->assertDatabaseHas('sponsors', ['name' => 'Intel']);
        $this->assertDatabaseHas('sponsors', ['name' => 'AMD']);
    }

    /**
     * Checks the number and names of the teams
     *
     * @return void
     */
    public function testTeamsData()
    {
        $count = Team::all()->count();
        $this->assertEquals($count, 7);

        $this->assertDatabaseHas('teams', ['name' => 'Screaming Nachos']);
        $this->assertDatabaseHas('teams', ['name' => 'Elemonators']);
        $this->assertDatabaseHas('teams', ['name' => 'E = MC Hammer']);
        $this->assertDatabaseHas('teams', ['name' => 'Chili Peppers']);
        $this->assertDatabaseHas('teams', ['name' => 'Low Expectations']);
        $this->assertDatabaseHas('teams', ['name' => 'Rescheduled']);
        $this->assertDatabaseHas('teams', ['name' => 'Get Your Kicks']);
    }

    /**
     * Checks the number and data of the players
     *
     * @return void
     */
    public function testPlayersData()
    {
        $count = Player::all()->count();
        $this->assertEquals($count, 9);

        $this->assertDatabaseHas('players', ['name' => 'John Doe', 'age' => 17]);
        $this->assertDatabaseHas('players', ['name' => 'Jim Baker', 'age' => 16]);
        $this->assertDatabaseHas('players', ['name' => 'Nick Alias', 'age' => 21]);
        $this->assertDatabaseHas('players', ['name' => 'Steve Bacon', 'age' => 17]);
        $this->assertDatabaseHas('players', ['name' => 'Mike Connor', 'age' => 18]);
        $this->assertDatabaseHas('players', ['name' => 'Tim Eater', 'age' => 17]);
        $this->assertDatabaseHas('players', ['name' => 'Billy Sheen', 'age' => 17]);
        $this->assertDatabaseHas('players', ['name' => 'Sam Uncle', 'age' => 17]);
        $this->assertDatabaseHas('players', ['name' => 'Rick Allister', 'age' => 19]);
    }

    /**
     * Checks the teams associated to the sponsors
     *
     * @return void
     */
    public function testTeamsBySponsor()
    {
        $sponsor = Sponsor::where('name', 'Samsung')->first();
        $this->assertEquals($sponsor->teams->count(), 2);
        $this->assertTrue($sponsor->teams->contains('name', 'Screaming Nachos'));
        $this->assertTrue($sponsor->teams->contains('name', 'Elemonators'));

        $sponsor = Sponsor::where('name', 'Toshiba')->first();
        $this->assertEquals($sponsor->teams->count(), 2);
        $this->assertTrue($sponsor->teams->contains('name', 'E = MC Hammer'));
        $this->assertTrue($sponsor->teams->contains('name', 'Chili Peppers'));

        $sponsor = Sponsor::where('name', 'Asus')->first();
        $this->assertEquals($sponsor->teams->count(), 1);
        $this->assertTrue($sponsor->teams->contains('name', 'Low Expectations'));

        $sponsor = Sponsor::where('name', 'Intel')->first();
        $this->assertEquals($sponsor->teams->count(), 1);
        $this->assertTrue($sponsor->teams->contains('name', 'Rescheduled'));

        $sponsor = Sponsor::where('name', 'AMD')->first();
        $this->assertEquals($sponsor->teams->count(), 1);
        $this->assertTrue($sponsor->teams->contains('name', 'Get Your Kicks'));
    }

    /**
     * Checks the players assigned to each team
     *
     * @return void
     */
    public function testPlayersByTeam()
    {
        $team = Team::where('name', 'Screaming Nachos')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'John Doe'));
        $this->assertTrue($team->players->contains('name', 'Jim Baker'));

        $team = Team::where('name', 'Elemonators')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'Jim Baker'));
        $this->assertTrue($team->players->contains('name', 'Sam Uncle'));

        $team = Team::where('name', 'E = MC Hammer')->first();
        $this->assertEquals($team->players->count(), 1);
        $this->assertTrue($team->players->contains('name', 'John Doe'));

        $team = Team::where('name', 'Chili Peppers')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'Nick Alias'));
        $this->assertTrue($team->players->contains('name', 'Sam Uncle'));

        $team = Team::where('name', 'Low Expectations')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'Steve Bacon'));
        $this->assertTrue($team->players->contains('name', 'Billy Sheen'));

        $team = Team::where('name', 'Rescheduled')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'Mike Connor'));
        $this->assertTrue($team->players->contains('name', 'Tim Eater'));

        $team = Team::where('name', 'Get Your Kicks')->first();
        $this->assertEquals($team->players->count(), 2);
        $this->assertTrue($team->players->contains('name', 'Tim Eater'));
        $this->assertTrue($team->players->contains('name', 'Rick Allister'));
    }
}
