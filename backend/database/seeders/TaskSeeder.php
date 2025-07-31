use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
public function run(): void
{
$user = User::first() ?? User::factory()->create(); // make sure at least one user exists

Task::create([
'user_id' => $user->id, // ✅ FIX
'title' => 'Finish Laravel project',
'description' => 'Complete all API endpoints and frontend integration',
'status' => 'pending',
'priority' => 'high',
'due_date' => Carbon::now()->addDays(3),
]);

Task::create([
'user_id' => $user->id, // ✅ FIX
'title' => 'Write documentation',
'description' => 'Include setup and usage instructions',
'status' => 'completed',
'priority' => 'medium',
'due_date' => Carbon::now()->addDays(5),
]);

Task::create([
'user_id' => $user->id, // ✅ FIX
'title' => 'Team meeting',
'description' => null,
'status' => 'pending',
'priority' => 'low',
'due_date' => null,
]);
}
}