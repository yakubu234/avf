<?php
declare(strict_types=1);

namespace AfroVerified\Repository;

use Doctrine\DBAL\Connection;

final class EventRepository
{
    /** @var Connection */
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function all(array $filters = []): array
    {
        $where = []; $params = [];
        if (!empty($filters['status'])) { $where[] = 'e.status = ?'; $params[] = $filters['status']; }
        if (!empty($filters['category'])) { $where[] = 'c.slug = ?'; $params[] = $filters['category']; }
        if (!empty($filters['city'])) { $where[] = 'e.city = ?'; $params[] = $filters['city']; }
        if (!empty($filters['featured'])) { $where[] = 'e.featured = 1'; }
        if (!empty($filters['sweet_reckless'])) { $where[] = 'e.sweet_reckless = 1'; }
        if (!empty($filters['q'])) { $where[] = '(e.name LIKE ? OR o.name LIKE ? OR e.city LIKE ?)'; $term = '%' . $filters['q'] . '%'; array_push($params, $term, $term, $term); }
        $limit = max(1, min(100, (int) ($filters['limit'] ?? 24)));
        $sql = "SELECT e.*, c.name category_name, c.slug category_slug, o.name organizer_name, o.company organizer_company, v.name venue_record_name FROM events e JOIN event_categories c ON c.id=e.category_id JOIN organizers o ON o.id=e.organizer_id LEFT JOIN venues v ON v.id=e.venue_id" . ($where ? ' WHERE ' . implode(' AND ', $where) : '') . " ORDER BY e.starts_at DESC LIMIT $limit";
        return $this->db->fetchAllAssociative($sql, $params);
    }

    public function find($id): ?array
    {
        $column = ctype_digit((string) $id) ? 'e.id' : 'e.slug';
        return $this->db->fetchAssociative("SELECT e.*, c.name category_name, c.slug category_slug, o.name organizer_name, o.email organizer_email, v.name venue_record_name FROM events e JOIN event_categories c ON c.id=e.category_id JOIN organizers o ON o.id=e.organizer_id LEFT JOIN venues v ON v.id=e.venue_id WHERE $column = ?", [$id]) ?: null;
    }

    public function dashboard(): array
    {
        return [
            'events' => (int) $this->db->fetchOne('SELECT COUNT(*) FROM events'),
            'published' => (int) $this->db->fetchOne("SELECT COUNT(*) FROM events WHERE status='published'"),
            'organizers' => (int) $this->db->fetchOne('SELECT COUNT(*) FROM organizers'),
            'users' => (int) $this->db->fetchOne('SELECT COUNT(*) FROM users'),
            'views' => (int) $this->db->fetchOne('SELECT COALESCE(SUM(views),0) FROM events'),
            'pending_submissions' => (int) $this->db->fetchOne("SELECT COUNT(*) FROM event_submissions WHERE status='pending'"),
            'categories' => $this->db->fetchAllAssociative('SELECT c.name, COUNT(e.id) total FROM event_categories c LEFT JOIN events e ON e.category_id=c.id GROUP BY c.id ORDER BY total DESC'),
        ];
    }
}
