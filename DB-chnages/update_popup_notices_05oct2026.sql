-- ====================================================================
-- Result Notifications Update (05 October 2026 / June-2026 Session)
-- Target Table: site_popup_notices
-- ====================================================================

-- 1. Ensure Table Exists
CREATE TABLE IF NOT EXISTS `site_popup_notices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(150) NOT NULL DEFAULT '',
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `description` TEXT NULL,
  `link` VARCHAR(500) NOT NULL DEFAULT '',
  `color_class` VARCHAR(50) NOT NULL DEFAULT 'is-navy',
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Shift existing notices down so new notices appear at the top
UPDATE `site_popup_notices` SET `sort_order` = `sort_order` + 4 WHERE `sort_order` >= 1;

-- 3. Insert 4 new result notifications
INSERT INTO `site_popup_notices` (`tag`, `title`, `description`, `link`, `color_class`, `sort_order`, `status`) VALUES
('RESULT NOTIFICATION • B.SC. B.ED', '📖 B.Sc. B.Ed – 6th Semester (Regular)', 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-green', 1, 1),
('RESULT NOTIFICATION • B.SC. B.ED', '📖 B.Sc. B.Ed – 5th, 3rd & 1st Semester (Ex)', 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-gold', 2, 1),
('RESULT NOTIFICATION • M.SC.', '🔬 M.Sc. – 2nd Semester (Regular) – All Branches', 'June-2026 post-graduate results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-blue', 3, 1),
('RESULT NOTIFICATION • M.SC.', '🔬 M.Sc. – 1st Semester (Ex) – All Branches', 'June-2026 post-graduate examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-purple', 4, 1);
