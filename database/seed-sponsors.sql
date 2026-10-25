-- Sample sponsors for the homepage slider.
-- Requires migration Version20261025120000 (sponsors table) and the logos in assets/images/sponsors/.
-- Safe to run repeatedly: a sponsor is skipped if one with the same name already exists.

INSERT INTO sponsors (name, logo, website, tagline, status, sort_order, created_at, updated_at)
SELECT s.name, s.logo, s.website, s.tagline, 'active', s.sort_order, NOW(), NOW()
FROM (
    SELECT 'Sankofa Bank' AS name, 'assets/images/sponsors/sankofa-bank.svg' AS logo, NULL AS website, 'Banking the diaspora' AS tagline, 1 AS sort_order
    UNION ALL SELECT 'Lagos Lager', 'assets/images/sponsors/lagos-lager.svg', NULL, 'Official beer partner', 2
    UNION ALL SELECT 'Harmattan Mobile', 'assets/images/sponsors/harmattan-mobile.svg', NULL, 'Connectivity partner', 3
    UNION ALL SELECT 'Kente Studios', 'assets/images/sponsors/kente-studios.svg', NULL, 'Creative & media partner', 4
    UNION ALL SELECT 'Palmwine Records', 'assets/images/sponsors/palmwine-records.svg', NULL, 'Official music partner', 5
    UNION ALL SELECT 'Savannah Airways', 'assets/images/sponsors/savannah-air.svg', NULL, 'Official travel partner', 6
    UNION ALL SELECT 'Jollof & Co.', 'assets/images/sponsors/jollof-and-co.svg', NULL, 'Food & hospitality partner', 7
) s
WHERE NOT EXISTS (SELECT 1 FROM sponsors existing WHERE existing.name = s.name);
