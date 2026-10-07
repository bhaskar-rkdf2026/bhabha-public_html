-- ======================================================================
-- Migration: Add Program Categories Management & Integrated Programmes
-- Date: 07-Oct-2026
-- Description:
-- 1. Updates table `program` schema with slug, icon, sort_order, status.
-- 2. Seeds standard categories (Undergraduate, Postgraduate, Doctoral, Diploma, Certificate, Integrated Programmes).
-- 3. Adds requested 'B.Sc. B.Ed. (4 Years Integrated)' course under Education (dept id 6) and Integrated category (prog id 6).
-- ======================================================================

ALTER TABLE `program` 
  MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT,
  MODIFY COLUMN `program` varchar(150) DEFAULT NULL;

-- Add columns if not already existing
ALTER TABLE `program` 
  ADD COLUMN IF NOT EXISTS `slug` varchar(100) DEFAULT NULL AFTER `program`,
  ADD COLUMN IF NOT EXISTS `icon` varchar(60) DEFAULT 'fa-graduation-cap' AFTER `slug`,
  ADD COLUMN IF NOT EXISTS `sort_order` int(11) DEFAULT 0 AFTER `icon`,
  ADD COLUMN IF NOT EXISTS `status` tinyint(1) DEFAULT 1 AFTER `sort_order`;

ALTER TABLE `course` 
  MODIFY COLUMN `program` int(11) DEFAULT NULL;

-- Update existing program rows with clean metadata
UPDATE `program` SET `program` = 'Under Graduate', `slug` = 'undergraduate', `icon` = 'fa-graduation-cap', `sort_order` = 1, `status` = 1 WHERE `id` = 3;
UPDATE `program` SET `program` = 'Post Graduate', `slug` = 'postgraduate', `icon` = 'fa-book', `sort_order` = 2, `status` = 1 WHERE `id` = 2;
UPDATE `program` SET `program` = 'Doctoral (Ph.D)', `slug` = 'doctoral', `icon` = 'fa-university', `sort_order` = 3, `status` = 1 WHERE `id` = 1;
UPDATE `program` SET `program` = 'Diploma', `slug` = 'diploma', `icon` = 'fa-certificate', `sort_order` = 4, `status` = 1 WHERE `id` = 4;
UPDATE `program` SET `program` = 'Certificate', `slug` = 'certificate', `icon` = 'fa-file-text-o', `sort_order` = 5, `status` = 1 WHERE `id` = 5;

-- Insert Integrated Programmes if not exists
INSERT INTO `program` (`id`, `program`, `slug`, `icon`, `sort_order`, `status`) 
VALUES (6, 'Integrated Programmes', 'integrated', 'fa-cubes', 6, 1)
ON DUPLICATE KEY UPDATE `program` = 'Integrated Programmes', `slug` = 'integrated', `icon` = 'fa-cubes', `sort_order` = 6, `status` = 1;

-- Insert B.Sc. B.Ed. (4 Years Integrated) course
INSERT INTO `course` (`program`, `course`, `department`, `details`, `status`)
SELECT 6, 'B.Sc. B.Ed. (4 Years Integrated)', 6, '<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%; border-collapse:collapse; margin-top:15px;\">\r\n\t<thead>\r\n\t\t<tr style=\"background:#0A1B54; color:#ffffff;\">\r\n\t\t\t<th colspan=\"4\" style=\"padding:14px; text-align:left; font-size:16px;\">COLLEGE - BHABHA COLLEGE OF EDUCATION, BHOPAL (APPROVED BY NCTE & UGC)</th>\r\n\t\t</tr>\r\n\t\t<tr style=\"background:#f8f9fa;\">\r\n\t\t\t<th style=\"padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;\">COURSE</th>\r\n\t\t\t<th style=\"padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;\">DURATION</th>\r\n\t\t\t<th style=\"padding:12px; border:1px solid #ddd; text-align:center; color:#0A1B54;\">SEATS</th>\r\n\t\t\t<th style=\"padding:12px; border:1px solid #ddd; text-align:left; color:#0A1B54;\">ELIGIBILITY & ADMISSION CRITERIA</th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td style=\"padding:14px; border:1px solid #ddd; vertical-align:top;\">\r\n\t\t\t\t<strong style=\"color:#0A1B54; font-size:15px;\">B.Sc. B.Ed. (4 Years Integrated Course)</strong><br>\r\n\t\t\t\t<span style=\"font-size:12.5px; color:#64748B;\">Department: Faculty of Education & Science</span><br>\r\n\t\t\t\t<span style=\"display:inline-block; margin-top:6px; padding:3px 8px; background:#EEF2FF; color:#1E40AF; border-radius:4px; font-size:11px; font-weight:700;\">NCTE Approved 4-Year Integrated Dual Degree</span>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#374151;\">\r\n\t\t\t\t4 Years<br>\r\n\t\t\t\t<span style=\"font-size:11.5px; font-weight:normal; color:#6B7280;\">(8 Semesters)</span>\r\n\t\t\t</td>\r\n\t\t\t<td style=\"padding:14px; border:1px solid #ddd; text-align:center; vertical-align:top; font-weight:700; color:#0A1B54; font-size:15px;\">\r\n\t\t\t\t50 Seats\r\n\t\t\t</td>\r\n\t\t\t<td style=\"padding:14px; border:1px solid #ddd; vertical-align:top; font-size:13px; line-height:1.7; color:#374151;\">\r\n\t\t\t\t<p style=\"margin:0 0 8px 0;\"><strong>1. Academic Eligibility:</strong> Candidates must have passed Senior Secondary / 10+2 examination or equivalent with Science stream (Physics, Chemistry, and Mathematics/Biology) from a recognized Board with a minimum of <strong>50% aggregate marks</strong>.</p>\r\n\t\t\t\t<p style=\"margin:0 0 8px 0;\"><strong>2. Relaxation:</strong> A relaxation of <strong>5% marks</strong> in the qualifying examination is allowed for candidates belonging to SC / ST / OBC categories as per NCTE and MP State Government rules (Minimum 45%).</p>\r\n\t\t\t\t<p style=\"margin:0;\"><strong>3. Admission Mode:</strong> Merit-based admission through university counseling or MP Higher Education Department portal guidelines.</p>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>', 1\r\nWHERE NOT EXISTS (SELECT 1 FROM `course` WHERE `course` LIKE '%B.Sc%B.Ed%' OR `course` LIKE '%BSCBED%');\r\n
