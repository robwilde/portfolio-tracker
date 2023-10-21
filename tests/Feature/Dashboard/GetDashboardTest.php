<?php

namespace Tests\Feature\Dashboard;

use App\Models\DividendPayout;
use App\Models\Holding;
use App\Models\Portfolio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_load_the_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $portfolio = Portfolio::factory()->create([
            'name' => 'Story Fund',
            'user_id' => $user,
        ]);
        $holding = Holding::factory()->create([
            'portfolio_id' => $portfolio,
            'user_id' => $user,
            'invested_capital' => 150,
        ]);
        DividendPayout::factory()->create([
            'user_id' => $user,
            'holding_id' => $holding,
            'paid_at' => '2021-12-06',
            'amount' => 5,
        ]);

        $this->travelTo(Carbon::parse('2021-12-06'), function () {
            $this->get('/dashboard')
                ->assertStatus(200)
                ->assertSee('All')
                ->assertSee('Story Fund')
                ->assertSee('$150.00')
                ->assertSee('All')
                ->assertSee('$150.00')
                ->assertSee('This Week')
                ->assertSee('$5.00')
                ->assertSee('This Month')
                ->assertSee('$5.00')
                ->assertSee('This Year')
                ->assertSee('$5.00')
                ->assertSee('All Time')
                ->assertSee('$5.00')
                ->assertSee('Dec, 2021')
                ->assertSee('$5.00');
        });
    }
}
