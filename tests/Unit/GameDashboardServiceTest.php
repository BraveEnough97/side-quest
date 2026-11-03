namespace Tests\Unit;

use App\Services\GameServer;
use Tests\TestCase;

class GameServerTest extends TestCase
{
    public function test_it_can_start_a_game_server()
    {
        $service = new GameDashboardService();

        // Assume we pass a server ID
        $status = $service->start(1);

        $this->assertEquals('running', $status);
    }
}
