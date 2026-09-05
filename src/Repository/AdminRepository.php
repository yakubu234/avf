<?php
declare(strict_types=1);

namespace AfroVerified\Repository;

use Doctrine\DBAL\Connection;

final class AdminRepository
{
    /** @var Connection */
    private $db;
    public function __construct(Connection $db) { $this->db = $db; }
    public function dashboard(): array { return ['events'=>(int)$this->db->fetchOne('SELECT COUNT(*) FROM events'),'published'=>(int)$this->db->fetchOne("SELECT COUNT(*) FROM events WHERE status='published'"),'organizers'=>(int)$this->db->fetchOne('SELECT COUNT(*) FROM organizers'),'users'=>(int)$this->db->fetchOne('SELECT COUNT(*) FROM users'),'views'=>(int)$this->db->fetchOne('SELECT COALESCE(SUM(views),0) FROM events'),'pending'=>(int)$this->db->fetchOne("SELECT COUNT(*) FROM event_submissions WHERE status='pending'")]; }
    public function events(int $limit=100): array { $limit=max(1,min(100,$limit));return $this->db->fetchAllAssociative("SELECT e.*,c.name category_name,o.name organizer_name FROM events e JOIN event_categories c ON c.id=e.category_id JOIN organizers o ON o.id=e.organizer_id ORDER BY e.starts_at DESC LIMIT $limit"); }
    public function event(int $id): ?array { return $this->db->fetchAssociative('SELECT e.*,c.name category_name,o.name organizer_name,o.email organizer_email FROM events e JOIN event_categories c ON c.id=e.category_id JOIN organizers o ON o.id=e.organizer_id WHERE e.id=?',[$id])?:null; }
    public function categories(): array { return $this->db->fetchAllAssociative('SELECT c.*,COUNT(e.id) event_count FROM event_categories c LEFT JOIN events e ON e.category_id=c.id GROUP BY c.id ORDER BY c.name'); }
    public function venues(): array { return $this->db->fetchAllAssociative('SELECT * FROM venues ORDER BY name'); }
    public function organizers(): array { return $this->db->fetchAllAssociative('SELECT o.*,COUNT(e.id) event_count FROM organizers o LEFT JOIN events e ON e.organizer_id=o.id GROUP BY o.id ORDER BY o.name'); }
    public function users(): array { return $this->db->fetchAllAssociative('SELECT id,name,email,role,status,phone,location,last_active_at,created_at FROM users ORDER BY id DESC'); }
    public function promotions(): array { return $this->db->fetchAllAssociative('SELECT p.*,o.name organizer_name FROM promotions p LEFT JOIN organizers o ON o.id=p.organizer_id ORDER BY p.starts_at DESC'); }
    public function submissions(): array { return $this->db->fetchAllAssociative('SELECT * FROM event_submissions ORDER BY id DESC'); }
    public function templates(): array { return $this->db->fetchAllAssociative('SELECT * FROM message_templates ORDER BY id DESC'); }
    public function signatures(): array { return $this->db->fetchAllAssociative('SELECT * FROM email_signatures ORDER BY id DESC'); }
    public function notifications(): array { return $this->db->fetchAllAssociative('SELECT * FROM notification_definitions ORDER BY id DESC'); }
    public function settings(string $group): array { return $this->db->fetchAllKeyValue('SELECT setting_key,setting_value FROM settings WHERE setting_group=?',[$group]); }
    public function currentVibe(): ?array { return $this->db->fetchAssociative("SELECT * FROM vibe_editions ORDER BY status='active' DESC,starts_on DESC LIMIT 1")?:null; }
}
