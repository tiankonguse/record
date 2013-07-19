SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tiankong_tksite` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `tiankong_tksite`;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_record` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `content` LONGTEXT NOT NULL ,
  `time` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_tag_map` (
  `tag_id` INT(11) NOT NULL ,
  `record_id` INT(11) NOT NULL ,
  PRIMARY KEY (`tag_id`, `record_id`) ,
  INDEX `fk_share_tag_map_share_record1_idx` (`record_id` ASC) ,
  INDEX `fk_share_tag_map_share_tag1_idx` (`tag_id` ASC) ,
  CONSTRAINT `fk_share_tag_map_share_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `tiankong_tksite`.`share_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_share_tag_map_share_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `tiankong_tksite`.`share_tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_comment` (
  `id` INT(11) NOT NULL ,
  `pre` INT(11) NOT NULL DEFAULT 0 ,
  `name` VARCHAR(45) NOT NULL ,
  `content` LONGTEXT NOT NULL ,
  `time` BIGINT(20) NOT NULL ,
  `tiankong_tksite` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_share_comment_share_record_idx` (`tiankong_tksite` ASC) ,
  CONSTRAINT `fk_share_comment_share_record`
    FOREIGN KEY (`tiankong_tksite` )
    REFERENCES `tiankong_tksite`.`share_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_big_class` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_small_class` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_map_big_small_tag` (
  `big_id` INT(11) NOT NULL ,
  `small_id` INT(11) NOT NULL ,
  PRIMARY KEY (`big_id`, `small_id`) ,
  INDEX `fk_share_map_big_small_tag_share_big_class1_idx` (`big_id` ASC) ,
  INDEX `fk_share_map_big_small_tag_share_small_class1_idx` (`small_id` ASC) ,
  CONSTRAINT `fk_share_map_big_small_tag_share_big_class1`
    FOREIGN KEY (`big_id` )
    REFERENCES `tiankong_tksite`.`share_big_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_share_map_big_small_tag_share_small_class1`
    FOREIGN KEY (`small_id` )
    REFERENCES `tiankong_tksite`.`share_small_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `tiankong_tksite`.`share_map_class_record` (
  `record_id` INT(11) NOT NULL ,
  `class_id` INT(11) NOT NULL ,
  PRIMARY KEY (`record_id`, `class_id`) ,
  INDEX `fk_share_map_class_record_share_record1_idx` (`record_id` ASC) ,
  INDEX `fk_share_map_class_record_share_small_class1_idx` (`class_id` ASC) ,
  CONSTRAINT `fk_share_map_class_record_share_record1`
    FOREIGN KEY (`record_id` )
    REFERENCES `tiankong_tksite`.`share_record` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_share_map_class_record_share_small_class1`
    FOREIGN KEY (`class_id` )
    REFERENCES `tiankong_tksite`.`share_small_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
