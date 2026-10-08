-- Database updates for dynamic approval and affiliation tags
-- Date: 07-Oct-2026

ALTER TABLE `department` ADD COLUMN IF NOT EXISTS `approval_tag` VARCHAR(150) NULL DEFAULT NULL AFTER `approval_text`;
ALTER TABLE `department` ADD COLUMN IF NOT EXISTS `affiliation_tag` VARCHAR(150) NULL DEFAULT NULL AFTER `affiliation_text`;

ALTER TABLE `institute` ADD COLUMN IF NOT EXISTS `approval_tag` VARCHAR(150) NULL DEFAULT NULL AFTER `approval_text`;
ALTER TABLE `institute` ADD COLUMN IF NOT EXISTS `affiliation_tag` VARCHAR(150) NULL DEFAULT NULL AFTER `affiliation_text`;

ALTER TABLE `sub_department` ADD COLUMN IF NOT EXISTS `approval_tag` VARCHAR(150) NULL DEFAULT NULL;
ALTER TABLE `sub_department` ADD COLUMN IF NOT EXISTS `affiliation_tag` VARCHAR(150) NULL DEFAULT NULL;

-- Initial default tags for departments
UPDATE `department` SET `approval_tag` = 'AICTE / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 1;
UPDATE `department` SET `approval_tag` = 'PCI / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 2;
UPDATE `department` SET `approval_tag` = 'DCI / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 3;
UPDATE `department` SET `approval_tag` = 'AICTE / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 4;
UPDATE `department` SET `approval_tag` = 'AICTE / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 5;
UPDATE `department` SET `approval_tag` = 'NCTE / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 6;
UPDATE `department` SET `approval_tag` = 'AICTE / UGC Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 7;
UPDATE `department` SET `approval_tag` = 'ICAR / UGC Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 8;
UPDATE `department` SET `approval_tag` = 'BCI / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 9;
UPDATE `department` SET `approval_tag` = 'UGC / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 10;
UPDATE `department` SET `approval_tag` = 'UGC / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 11;
UPDATE `department` SET `approval_tag` = 'UGC / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 12;
UPDATE `department` SET `approval_tag` = 'INC / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 13;
UPDATE `department` SET `approval_tag` = 'UGC / Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 14;
UPDATE `department` SET `approval_tag` = 'State Paramedical Council', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 15;
UPDATE `department` SET `approval_tag` = 'NCH / AYUSH Recognized', `affiliation_tag` = 'Bhabha University Bhopal' WHERE `id` = 16;
