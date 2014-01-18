SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `tiankong_site`.`record_record`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiankong_site`.`record_record` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `content` LONGTEXT NOT NULL ,
  `time` BIGINT NOT NULL ,
  `last_time` BIGINT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tiankong_site`.`record_tag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiankong_site`.`record_tag` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiankong_site`.`record_tag_map`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiankong_site`.`record_tag_map` (
  `tag_id` INT NOT NULL ,
  `record_id` INT NOT NULL ,
  PRIMARY KEY (`tag_id`, `record_id`) ,
  INDEX `fk_share_tag_map_share_record1_idx` (`record_id` ASC) ,
  INDEX `fk_record_tag_map_record_tag1` (`tag_id` ASC) ,
  CONSTRAINT `fk_share_tag_map_share_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `tiankong_site`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_record_tag_map_record_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tiankong_site`.`record_tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiankong_site`.`record_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiankong_site`.`record_comment` (
  `id` INT NOT NULL ,
  `pre` INT NOT NULL DEFAULT 0 ,
  `name` VARCHAR(45) NOT NULL ,
  `content` LONGTEXT NOT NULL ,
  `time` BIGINT NOT NULL ,
  `record` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_share_comment_share_record_idx` (`record` ASC) ,
  CONSTRAINT `fk_share_comment_share_record`
    FOREIGN KEY (`record` )
    REFERENCES `tiankong_site`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
