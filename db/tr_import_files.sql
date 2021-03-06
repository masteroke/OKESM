CREATE TABLE IF NOT EXISTS `tr_import_files` (
  `sec` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(200) NOT NULL,
  `file_path` VARCHAR(200) NOT NULL,
  `user` INT(10) NOT NULL,
  `ip` VARCHAR(45) NOT NULL,
  `alias` VARCHAR(45) NULL,
  `data_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `host` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`sec`, `user`))
ENGINE = InnoDB;