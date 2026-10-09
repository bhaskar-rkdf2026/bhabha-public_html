-- ==========================================================
-- Schema & Seed Data for table `site_popup_notices`
-- ==========================================================

CREATE TABLE IF NOT EXISTS `site_popup_notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(150) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `link` varchar(500) NOT NULL DEFAULT '',
  `color_class` varchar(50) NOT NULL DEFAULT 'is-navy',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Default seed data (Total: 9 rows)
INSERT IGNORE INTO `site_popup_notices` (`id`, `tag`, `title`, `description`, `link`, `color_class`, `sort_order`, `status`, `created_at`) VALUES
('1', 'RESULT NOTIFICATION • B.PHARM', '🎓 B.Pharm – 4th Semester (Regular)', 'Examination results declared and published on the official portal.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-navy', '5', '1', '2026-10-05 11:29:04'),
('2', 'RESULT NOTIFICATION • DIPLOMA HMCT', '🍽️ Diploma HMCT – 1st Year (Regular)', '1st Year annual examination marksheet and result live.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-gold', '6', '1', '2026-10-05 11:29:04'),
('3', 'RESULT NOTIFICATION • M.PHARM', '🔬 M.Pharm – 2nd Semester (Regular)', 'Post-graduate semester examination results available online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-blue', '7', '1', '2026-10-05 11:29:04'),
('4', 'RESULT NOTIFICATION • B.SC. B.ED', '📖 B.Sc. B.Ed – 2nd Semester (Regular)', '4-Year integrated programme results declared.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-green', '8', '1', '2026-10-05 11:29:04'),
('5', 'RESULT NOTIFICATION • B.PHARM', '🎓 B.Pharm – 2nd Semester (Regular)', '2nd Semester regular examination results declared.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-navy', '9', '1', '2026-10-05 11:29:04'),
('6', 'RESULT NOTIFICATION • B.SC. B.ED', '📖 B.Sc. B.Ed – 6th Semester (Regular)', 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-green', '1', '1', '2026-10-06 15:52:31'),
('7', 'RESULT NOTIFICATION • B.SC. B.ED', '📖 B.Sc. B.Ed – 5th, 3rd & 1st Semester (Ex)', 'June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-gold', '2', '1', '2026-10-06 15:52:31'),
('8', 'RESULT NOTIFICATION • M.SC.', '🔬 M.Sc. – 2nd Semester (Regular) – All Branches', 'June-2026 post-graduate results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-blue', '3', '1', '2026-10-06 15:52:31'),
('9', 'RESULT NOTIFICATION • M.SC.', '🔬 M.Sc. – 1st Semester (Ex) – All Branches', 'June-2026 post-graduate examination results declared (05 Oct 2026). All concerned students please check your results online.', 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx', 'is-purple', '4', '1', '2026-10-06 15:52:31');
