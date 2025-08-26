
<?php

require_once '../../vendor/autoload.php';

$app = require_once '../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;

AuthHelper::start_secure_session();

if (AuthHelper::is_logged_in()) {
    $user_id = Auth::user()->id;
    error_log("User ID $user_id logged out at " . date('Y-m-d H:i:s'));
}

AuthHelper::logout_user();

header("Location: login.php?logout=success");
exit;
?>