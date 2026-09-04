<?php
declare(strict_types=1);

use AfroVerified\Auth;
use AfroVerified\Database;
use AfroVerified\Http\JsonResponse;
use AfroVerified\Repository\EventRepository;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $route = trim($_GET['route'] ?? '', '/');
    $parts = $route === '' ? [] : explode('/', $route);
    $db = Database::connection();
    $events = new EventRepository($db);

    if ($route === 'health') JsonResponse::send(['status' => 'ok', 'database' => $db->connect() === null ? 'connected' : 'connected']);
    if ($route === 'auth/login' && $method === 'POST') {
        $input = JsonResponse::input();
        $user = Auth::login(trim((string) ($input['email'] ?? '')), (string) ($input['password'] ?? ''));
        JsonResponse::send($user ? ['user' => $user] : ['error' => 'Invalid credentials'], $user ? 200 : 422);
    }
    if ($route === 'auth/me') JsonResponse::send(['user' => Auth::user()]);
    if ($route === 'auth/csrf') { Auth::requireAdmin(); JsonResponse::send(['token' => Auth::csrfToken()]); }
    if ($route === 'auth/logout' && $method === 'POST') { Auth::start(); session_destroy(); JsonResponse::send(['ok' => true]); }

    if ($route === 'events' && $method === 'GET') JsonResponse::send(['data' => $events->all($_GET)]);
    if (($parts[0] ?? '') === 'events' && isset($parts[1]) && $method === 'GET') {
        $event = $events->find($parts[1]); JsonResponse::send($event ? ['data' => $event] : ['error' => 'Event not found'], $event ? 200 : 404);
    }
    if ($route === 'dashboard' && $method === 'GET') { Auth::requireAdmin(); JsonResponse::send(['data' => $events->dashboard()]); }
    if ($route === 'categories' && $method === 'GET') JsonResponse::send(['data' => $db->fetchAllAssociative("SELECT c.*, COUNT(e.id) event_count FROM event_categories c LEFT JOIN events e ON e.category_id=c.id GROUP BY c.id ORDER BY c.name")]);
    if ($route === 'venues' && $method === 'GET') JsonResponse::send(['data' => $db->fetchAllAssociative('SELECT * FROM venues ORDER BY name')]);
    if ($route === 'organizers' && $method === 'GET') JsonResponse::send(['data' => $db->fetchAllAssociative("SELECT o.*, COUNT(e.id) event_count FROM organizers o LEFT JOIN events e ON e.organizer_id=o.id GROUP BY o.id ORDER BY o.name")]);
    if ($route === 'promotions' && $method === 'GET') JsonResponse::send(['data' => $db->fetchAllAssociative('SELECT * FROM promotions ORDER BY starts_at DESC')]);
    if ($route === 'vibe/current' && $method === 'GET') JsonResponse::send(['data' => $db->fetchAssociative("SELECT * FROM vibe_editions WHERE status='active' ORDER BY starts_on DESC LIMIT 1"), 'events' => $events->all(['status' => 'published', 'limit' => 5])]);
    if ($route === 'submissions' && $method === 'POST') {
        $input = JsonResponse::input();
        foreach (['eventName','email'] as $required) if (empty($input[$required])) JsonResponse::send(['error' => "$required is required"], 422);
        $db->insert('event_submissions', ['submitted_by_name' => $input['contactName'] ?? $input['organizer'] ?? 'Guest', 'submitted_by_email' => $input['email'], 'submitted_by_phone' => $input['phone'] ?? null, 'payload' => json_encode($input, JSON_THROW_ON_ERROR), 'status' => 'pending', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        JsonResponse::send(['ok' => true, 'id' => (int) $db->lastInsertId()], 201);
    }
    if ($route === 'newsletter' && $method === 'POST') {
        $input = JsonResponse::input(); $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$email) JsonResponse::send(['error' => 'A valid email is required'], 422);
        $db->executeStatement("INSERT INTO newsletter_subscribers(email,source,status,subscribed_at) VALUES(?,?,'active',NOW()) ON DUPLICATE KEY UPDATE status='active'", [$email, $input['source'] ?? 'website']);
        JsonResponse::send(['ok' => true], 201);
    }

    if (($parts[0] ?? '') === 'admin' && ($parts[1] ?? '') === 'settings' && isset($parts[2])) {
        $user=Auth::requireAdmin();$group=preg_replace('/[^a-z0-9_-]/i','',$parts[2]);
        if($method==='GET')JsonResponse::send(['data'=>$db->fetchAllAssociative('SELECT setting_key, setting_value FROM settings WHERE setting_group=?',[$group])]);
        Auth::requireCsrf();$input=JsonResponse::input();
        foreach($input as $key=>$value)$db->executeStatement('INSERT INTO settings(setting_group,setting_key,setting_value,is_public,updated_by,updated_at) VALUES(?,?,?,0,?,NOW()) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value),updated_by=VALUES(updated_by),updated_at=NOW()',[$group,preg_replace('/[^a-z0-9_-]/i','',(string)$key),json_encode($value,JSON_THROW_ON_ERROR),$user['id']]);
        JsonResponse::send(['ok'=>true]);
    }
    if ($route === 'admin/uploads' && $method === 'POST') {
        Auth::requireAdmin(); Auth::requireCsrf();
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) JsonResponse::send(['error'=>'A valid upload is required'],422);
        $file=$_FILES['file']; if ($file['size'] > 5*1024*1024) JsonResponse::send(['error'=>'Maximum upload size is 5 MB'],422);
        $mime=(new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);$extensions=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
        if (!isset($extensions[$mime])) JsonResponse::send(['error'=>'Only JPG, PNG and WebP images are allowed'],422);
        $directory=dirname(__DIR__).'/uploads';if(!is_dir($directory))mkdir($directory,0775,true);$name=bin2hex(random_bytes(16)).'.'.$extensions[$mime];
        if(!move_uploaded_file($file['tmp_name'],$directory.'/'.$name))JsonResponse::send(['error'=>'Upload could not be stored'],500);
        JsonResponse::send(['ok'=>true,'path'=>'uploads/'.$name],201);
    }
    if (str_starts_with($route, 'admin/')) {
        $user = Auth::requireAdmin(); $resource = $parts[1] ?? ''; $id = isset($parts[2]) ? (int) $parts[2] : null;
        $allowed = ['events' => 'events', 'categories' => 'event_categories', 'venues' => 'venues', 'organizers' => 'organizers', 'promotions' => 'promotions', 'submissions' => 'event_submissions', 'users' => 'users', 'templates' => 'message_templates', 'signatures' => 'email_signatures', 'notifications' => 'notification_definitions'];
        if (!isset($allowed[$resource])) JsonResponse::send(['error' => 'Unknown resource'], 404);
        $table = $allowed[$resource];
        if ($method === 'GET') JsonResponse::send(['data' => $db->fetchAllAssociative("SELECT * FROM $table ORDER BY id DESC LIMIT 100")]);
        Auth::requireCsrf();
        $input = JsonResponse::input();
        $columns = [
            'events'=>['category_id','venue_id','organizer_id','name','slug','subtitle','description','event_type','subcategory','starts_at','ends_at','city','country','venue_name','venue_address','poster','hero_image','instagram','website','ticket_url','age_restriction','dress_code','status','featured','sweet_reckless'],
            'categories'=>['name','slug','description','icon','color','status'], 'venues'=>['name','slug','address','city','region','country','capacity','image','status'],
            'organizers'=>['user_id','name','company','email','phone','city','country','instagram','website','logo','status'], 'promotions'=>['event_id','organizer_id','name','slug','type','description','image','starts_at','ends_at','status'],
            'submissions'=>['status','admin_notes','reviewed_by','reviewed_at'], 'users'=>['name','email','role','status','phone','location','avatar'],
            'templates'=>['name','channel','category','subject','html_body','text_body','status'], 'signatures'=>['name','html_body','text_body','status'], 'notifications'=>['name','category','channels','status']
        ];
        $input = array_intersect_key($input, array_flip($columns[$resource]));
        foreach (['channels'] as $jsonField) if (isset($input[$jsonField]) && is_array($input[$jsonField])) $input[$jsonField] = json_encode($input[$jsonField], JSON_THROW_ON_ERROR);
        if ($method === 'POST') { if (!$input) JsonResponse::send(['error'=>'No valid fields supplied'],422); if (array_key_exists('created_at',$db->createSchemaManager()->listTableColumns($table))) $input['created_at']=date('Y-m-d H:i:s'); $input['updated_at']=date('Y-m-d H:i:s'); $db->insert($table,$input); JsonResponse::send(['ok'=>true,'id'=>(int)$db->lastInsertId()],201); }
        if ($method === 'PATCH' && $id) { if (!$input) JsonResponse::send(['error'=>'No valid fields supplied'],422); $input['updated_at'] = date('Y-m-d H:i:s'); $db->update($table, $input, ['id' => $id]); JsonResponse::send(['ok' => true]); }
        if ($method === 'DELETE' && $id) { $db->delete($table, ['id' => $id]); JsonResponse::send(['ok' => true]); }
    }
    JsonResponse::send(['error' => 'Route not found'], 404);
} catch (Throwable $e) {
    JsonResponse::send(['error' => getenv('APP_ENV') === 'production' ? 'Server error' : $e->getMessage()], 500);
}
