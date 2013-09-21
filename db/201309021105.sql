SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `record` DEFAULT CHARACTER SET utf8 ;
USE `record` ;

-- -----------------------------------------------------
-- Table `record`.`record_record`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_record` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `content` LONGTEXT NOT NULL ,
  `time` BIGINT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_tag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_tag` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_tag_map`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_tag_map` (
  `tag_id` INT NOT NULL ,
  `record_id` INT NOT NULL ,
  PRIMARY KEY (`tag_id`, `record_id`) ,
  INDEX `fk_share_tag_map_share_record1_idx` (`record_id` ASC) ,
  CONSTRAINT `fk_share_tag_map_share_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `record`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_comment` (
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
    REFERENCES `record`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_big_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_big_class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_small_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_small_class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_map_big_small_tag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_map_big_small_tag` (
  `big_id` INT NOT NULL ,
  PRIMARY KEY (`big_id`) ,
  INDEX `fk_share_map_big_small_tag_share_big_class1_idx` (`big_id` ASC) ,
  CONSTRAINT `fk_share_map_big_small_tag_share_big_class1`
    FOREIGN KEY (`big_id` )
    REFERENCES `record`.`record_big_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_map_class_record`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_map_class_record` (
  `record_id` INT NOT NULL ,
  `class_id` INT NOT NULL ,
  PRIMARY KEY (`record_id`, `class_id`) ,
  INDEX `fk_share_map_class_record_share_record1_idx` (`record_id` ASC) ,
  INDEX `fk_share_map_class_record_share_small_class1_idx` (`class_id` ASC) ,
  CONSTRAINT `fk_share_map_class_record_share_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `record`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_share_map_class_record_share_small_class1`
    FOREIGN KEY (`class_id` )
    REFERENCES `record`.`record_small_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_big_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_big_class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `record`.`record_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `record`.`record_map`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `record`.`record_map` (
  `class_id` INT NOT NULL ,
  `record_id` INT NOT NULL ,
  PRIMARY KEY (`class_id`, `record_id`) ,
  INDEX `fk_record_map_record_class1` (`class_id` ASC) ,
  INDEX `fk_record_map_record_record1` (`record_id` ASC) ,
  CONSTRAINT `fk_record_map_record_class1`
    FOREIGN KEY (`class_id` )
    REFERENCES `record`.`record_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_record_map_record_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `record`.`record_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
