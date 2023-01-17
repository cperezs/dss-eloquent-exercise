<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Sponsor;

class SponsorTest extends TestCase
{
    /**
     * Checks isJuniorSponsor
     *
     * @return void
     */
    public function testIsJuniorSponsor()
    {
        $sponsor = Sponsor::where('name', 'Samsung')->first();
        $this->assertTrue($sponsor->isJuniorSponsor());

        $sponsor = Sponsor::where('name', 'Toshiba')->first();
        $this->assertFalse($sponsor->isJuniorSponsor());

        $sponsor = Sponsor::where('name', 'Asus')->first();
        $this->assertTrue($sponsor->isJuniorSponsor());

        $sponsor = Sponsor::where('name', 'Intel')->first();
        $this->assertFalse($sponsor->isJuniorSponsor());

        $sponsor = Sponsor::where('name', 'AMD')->first();
        $this->assertFalse($sponsor->isJuniorSponsor());
    }

    private function sponsor_in_array($arr, $sponsor) {
        $found = false;

        foreach ($arr as $obj) {
            if ($obj->name == $sponsor) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * Checks getJuniorSponsors
     *
     * @return void
     */
    public function testGetJuniorSponsors()
    {
        $sponsors = Sponsor::getJuniorSponsors();

        $this->assertEquals(count($sponsors), 2);
        $this->assertTrue($this->sponsor_in_array($sponsors, 'Samsung'));
        $this->assertTrue($this->sponsor_in_array($sponsors, 'Asus'));
    }
}
