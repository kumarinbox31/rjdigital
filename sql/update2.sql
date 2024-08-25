ALTER TABLE `centers`
ADD COLUMN `assistant_manager` VARCHAR(200) NULL AFTER `name`,
ADD COLUMN `reg_no` VARCHAR(200) NULL AFTER `assistant_manager`;
