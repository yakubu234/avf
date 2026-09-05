<?php
declare(strict_types=1);

use AfroVerified\Auth;
use AfroVerified\Database;
use AfroVerified\Repository\AdminRepository;

require dirname(__DIR__) . '/vendor/autoload.php';

$user=Auth::user();
if(!$user){$nestedRequest=strpos(parse_url($_SERVER['REQUEST_URI']??'',PHP_URL_PATH)?:'','/admin/settings/')!==false;header('Location: '.($nestedRequest?'../login.html':'login.html'),true,302);exit;}
$aliases=['event-categories'=>'categories','event-venues'=>'venues','event-submissions'=>'submissions','whats-the-vibe'=>'vibe','sweet-and-reckless'=>'sweet'];
$page=preg_replace('/[^a-z-]/','',(string)($_GET['page']??'dashboard'));$page=$aliases[$page]??$page;
$allowed=['dashboard','events','event-details','add-event','categories','venues','submissions','vibe','sweet','promotions','organizers','users','reports','communication','email','sms','templates','signatures','notifications'];
if(!in_array($page,$allowed,true)){http_response_code(404);$page='dashboard';}
$repository=new AdminRepository(Database::connection());$events=$repository->events();$metrics=$repository->dashboard();$records=[];
if($page==='categories')$records=$repository->categories();if($page==='venues')$records=$repository->venues();if($page==='submissions')$records=$repository->submissions();if($page==='organizers')$records=$repository->organizers();if($page==='users')$records=$repository->users();if($page==='promotions')$records=$repository->promotions();if($page==='templates')$records=$repository->templates();if($page==='signatures')$records=$repository->signatures();if($page==='notifications')$records=$repository->notifications();
$event=$page==='event-details'?$repository->event((int)($_GET['id']??($events[0]['id']??0))):null;$vibeEdition=in_array($page,['vibe','sweet'],true)?$repository->currentVibe():null;$settingValues=in_array($page,['communication','email','sms'],true)?$repository->settings($page):[];
require __DIR__.'/views/layout.php';
