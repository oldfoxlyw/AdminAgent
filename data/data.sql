SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `platform_content_db` ;
CREATE SCHEMA IF NOT EXISTS `platform_content_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `platform_content_db` ;

-- -----------------------------------------------------
-- Table `platform_content_db`.`web_channels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_channels` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_channels` (
  `channel_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `channel_name` CHAR(16) NOT NULL ,
  `channel_url` VARCHAR(255) NULL DEFAULT NULL ,
  `channel_father_id` INT(11) NOT NULL DEFAULT '0' ,
  `channel_web_id` INT(11) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`channel_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_config`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_config` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_config` (
  `config_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `config_name` VARCHAR(45) NOT NULL ,
  `config_close_scc` TINYINT(1) NOT NULL DEFAULT '0' ,
  `config_close_reason` TEXT NOT NULL ,
  `config_selected` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`config_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_links` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_links` (
  `link_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `link_content` TEXT NOT NULL ,
  PRIMARY KEY (`link_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_mail_autosend`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_mail_autosend` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_mail_autosend` (
  `auto_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `auto_template_id` INT(11) NOT NULL ,
  `auto_actived` TINYINT(1) NOT NULL DEFAULT '1' ,
  `auto_name` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`auto_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_mail_template`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_mail_template` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_mail_template` (
  `template_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `template_name` TEXT NULL DEFAULT NULL ,
  `template_content` TEXT NOT NULL ,
  `template_auto_send` TINYINT(4) NULL DEFAULT NULL ,
  `template_subject` TEXT NULL DEFAULT NULL ,
  `template_reader` VARCHAR(45) NULL DEFAULT NULL ,
  `smtp_host` VARCHAR(20) NOT NULL DEFAULT '67.228.209.12' ,
  `smtp_user` VARCHAR(45) NOT NULL DEFAULT 'contact@macxdvd.com' ,
  `smtp_pass` VARCHAR(45) NOT NULL DEFAULT 'cont333999' ,
  `smtp_from` VARCHAR(45) NOT NULL DEFAULT 'contact@macxdvd.com' ,
  `smtp_fromName` VARCHAR(45) NOT NULL DEFAULT 'contact@macxdvd.com' ,
  PRIMARY KEY (`template_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_media`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_media` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_media` (
  `media_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `media_title` CHAR(32) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `media_comment` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `media_type` INT(11) NOT NULL DEFAULT '1' COMMENT '1=视频,2=原画,3=截图' ,
  `media_pic_small` TEXT NULL DEFAULT NULL ,
  `media_url` TEXT CHARACTER SET 'utf8' NOT NULL ,
  `media_posttime` INT(11) NOT NULL DEFAULT '0' ,
  `media_index_show` TINYINT(1) NOT NULL DEFAULT '0' ,
  `media_web_id` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`media_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_news` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_news` (
  `news_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `news_title` TEXT NOT NULL ,
  `news_channel_id` INT(11) NULL DEFAULT '1' ,
  `news_intro` TEXT NULL DEFAULT NULL ,
  `news_content` TEXT NULL DEFAULT NULL ,
  `news_posttime` INT(11) NULL DEFAULT NULL ,
  `news_top_show` TINYINT(1) NULL DEFAULT '0' ,
  `news_tags` TEXT NULL DEFAULT NULL ,
  `news_keywords` TEXT NULL DEFAULT NULL ,
  `news_description` TEXT NULL DEFAULT NULL ,
  `news_display_title` TEXT NULL DEFAULT NULL ,
  `news_display_pic` TEXT NULL DEFAULT NULL ,
  `news_status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0=待审核,1=已审核' ,
  PRIMARY KEY (`news_id`) ,
  INDEX `news_status` USING BTREE (`news_status` ASC) ,
  INDEX `news_channel_id` USING BTREE (`news_channel_id` ASC) ,
  INDEX `news_top_show` USING BTREE (`news_top_show` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_partner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_partner` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_partner` (
  `GUID` VARCHAR(36) NOT NULL ,
  `user_name` VARCHAR(16) NOT NULL ,
  `user_pass` VARCHAR(64) NOT NULL ,
  `user_freezed` TINYINT(4) NOT NULL DEFAULT '0' ,
  `additional_permission` TEXT NULL DEFAULT NULL ,
  `partner_key` CHAR(16) NOT NULL ,
  PRIMARY KEY (`GUID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_permission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_permission` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_permission` (
  `permission_id` INT(11) NOT NULL ,
  `permission_name` VARCHAR(24) NOT NULL ,
  `permission_list` TEXT NOT NULL ,
  PRIMARY KEY (`permission_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_private_notice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_private_notice` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_private_notice` (
  `notice_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `notice_content` TEXT NOT NULL ,
  `notice_endtime` INT(11) NOT NULL DEFAULT '0' ,
  `notice_posttime` INT(11) NOT NULL DEFAULT '0' ,
  `notice_visible` TINYINT(1) NOT NULL DEFAULT '1' ,
  `notice_sender_id` VARCHAR(36) NOT NULL ,
  `notice_reciever_id` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`notice_id`) ,
  INDEX `notice_posttime` USING BTREE (`notice_posttime` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_slide`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_slide` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_slide` (
  `slide_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `slide_pic_path` TEXT NOT NULL ,
  `slide_pic_width` INT(11) NULL DEFAULT NULL ,
  `slide_pic_height` INT(11) NULL DEFAULT NULL ,
  `slide_link` TEXT NULL DEFAULT NULL ,
  `slide_web_id` INT(11) NOT NULL ,
  PRIMARY KEY (`slide_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_tags` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_tags` (
  `tag_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`tag_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_user` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_user` (
  `GUID` VARCHAR(36) NOT NULL ,
  `user_name` VARCHAR(16) NOT NULL ,
  `user_pass` VARCHAR(64) NOT NULL ,
  `user_permission` INT(11) NOT NULL DEFAULT '1' ,
  `user_founder` TINYINT(1) NOT NULL DEFAULT '0' ,
  `user_freezed` TINYINT(4) NOT NULL DEFAULT '0' ,
  `additional_permission` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`GUID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`web_web`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`web_web` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`web_web` (
  `web_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `web_name` VARCHAR(45) NULL DEFAULT NULL ,
  `web_url` VARCHAR(255) NULL DEFAULT NULL ,
  `web_secretkey` VARCHAR(64) NULL DEFAULT NULL ,
  PRIMARY KEY (`web_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`log_platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`log_platform` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`log_platform` (
  `log_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `log_type` VARCHAR(64) NOT NULL ,
  `log_user` VARCHAR(20) NULL DEFAULT NULL ,
  `log_relative_page_url` VARCHAR(128) NOT NULL ,
  `log_relative_parameter` TEXT NOT NULL ,
  `log_addition_parameter` TEXT NULL DEFAULT NULL ,
  `log_relative_method` VARCHAR(12) NOT NULL ,
  `log_time` DATETIME NOT NULL ,
  PRIMARY KEY (`log_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 180
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`funds_checkinout`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`funds_checkinout` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`funds_checkinout` (
  `funds_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `account_guid` CHAR(36) NOT NULL ,
  `account_name` CHAR(64) NOT NULL ,
  `account_nickname` CHAR(32) NOT NULL ,
  `account_id` CHAR(16) NOT NULL ,
  `game_id` CHAR(5) NOT NULL ,
  `server_id` CHAR(5) NOT NULL ,
  `server_section` CHAR(5) NOT NULL ,
  `funds_flow_dir` ENUM('CHECK_IN','CHECK_OUT') NOT NULL ,
  `funds_amount` INT(11) NOT NULL ,
  `funds_item_amount` INT(11) NOT NULL ,
  `funds_item_current` INT(11) NOT NULL ,
  `funds_time` INT(11) NOT NULL ,
  `funds_time_local` DATETIME NOT NULL ,
  `funds_type` INT(11) NOT NULL DEFAULT '1' COMMENT '1=游戏内充值 0=GM手动调整' ,
  PRIMARY KEY (`funds_id`) ,
  INDEX `account_guid` (`account_name` ASC) ,
  INDEX `account_id` (`account_id` ASC) ,
  INDEX `game_id` (`game_id` ASC, `server_id` ASC, `server_section` ASC) ,
  INDEX `funds_flow_dir` (`funds_flow_dir` ASC) ,
  INDEX `funds_time` (`funds_time` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 60
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`funds_order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`funds_order` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`funds_order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `player_id` CHAR(22) NOT NULL ,
  `game_id` CHAR(1) NOT NULL ,
  `section_id` CHAR(1) NOT NULL ,
  `server_id` CHAR(1) NOT NULL ,
  `checksum` CHAR(64) NOT NULL ,
  `check_count` INT(11) NOT NULL ,
  `posttime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `checksum_2` (`checksum` ASC) ,
  INDEX `checksum` (`checksum` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 60
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`report_overview`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`report_overview` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`report_overview` (
  `log_date` DATE NOT NULL ,
  `log_register_count` INT(11) NOT NULL ,
  `log_login_count` INT(11) NOT NULL ,
  `log_active_count` INT(11) NOT NULL ,
  `log_pay_count` INT(11) NOT NULL ,
  `log_payment_count` INT(11) NOT NULL ,
  `log_checkin_count` INT(11) NOT NULL ,
  `log_item_count` INT(11) NOT NULL COMMENT '充值的暗能水晶数' ,
  `log_checkout_count` INT(11) NOT NULL ,
  `log_arpu` INT NOT NULL ,
  `game_id` CHAR(5) NOT NULL ,
  `section_id` CHAR(5) NOT NULL ,
  `server_id` CHAR(5) NOT NULL ,
  PRIMARY KEY (`log_date`, `game_id`, `section_id`, `server_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`log_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`log_account` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`log_account` (
  `log_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `log_GUID` CHAR(36) NOT NULL ,
  `log_account_name` CHAR(64) NULL DEFAULT NULL ,
  `log_account_email` CHAR(128) NULL DEFAULT NULL ,
  `log_action` CHAR(64) NOT NULL ,
  `log_uri` CHAR(128) NOT NULL ,
  `log_method` CHAR(10) NULL DEFAULT NULL ,
  `log_parameter` TEXT NULL DEFAULT NULL ,
  `log_time` INT(11) NOT NULL DEFAULT '0' ,
  `log_time_local` DATETIME NOT NULL ,
  `log_ip` CHAR(24) NOT NULL ,
  `game_id` CHAR(5) NOT NULL ,
  `section_id` CHAR(5) NOT NULL ,
  `server_id` CHAR(5) NOT NULL ,
  `platform` ENUM('iphone','ipad','web') NOT NULL DEFAULT 'iphone' ,
  PRIMARY KEY (`log_id`) ,
  INDEX `log_GUID` USING BTREE (`log_GUID` ASC) ,
  INDEX `log_account_name` USING BTREE (`log_account_name` ASC) ,
  INDEX `log_time` USING BTREE (`log_time` ASC) ,
  INDEX `log_action` USING BTREE (`log_action` ASC) ,
  INDEX `game_id` (`game_id` ASC, `section_id` ASC, `server_id` ASC) ,
  INDEX `platform` (`platform` ASC) ,
  INDEX `log_ip` (`log_ip` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`game_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`game_product` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`game_product` (
  `game_id` CHAR(5) NOT NULL ,
  `game_name` CHAR(64) NOT NULL ,
  `game_version` CHAR(16) NOT NULL ,
  `game_platform` ENUM('web','ios','android') NULL DEFAULT 'ios' ,
  `auth_key` CHAR(128) NOT NULL ,
  `game_pic_small` TEXT NULL DEFAULT NULL ,
  `game_pic_middium` TEXT NULL DEFAULT NULL ,
  `game_pic_big` TEXT NULL DEFAULT NULL ,
  `game_download_iphone` TEXT NULL DEFAULT NULL ,
  `game_download_ipad` TEXT NULL DEFAULT NULL ,
  `game_status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0=正式,1=内测,2=公测' ,
  PRIMARY KEY (`game_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`game_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`game_section` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`game_section` (
  `game_id` CHAR(5) NOT NULL ,
  `server_section_id` CHAR(5) NOT NULL ,
  `section_name` CHAR(32) NOT NULL ,
  PRIMARY KEY (`server_section_id`, `game_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `platform_content_db`.`game_server`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `platform_content_db`.`game_server` ;

CREATE  TABLE IF NOT EXISTS `platform_content_db`.`game_server` (
  `game_id` CHAR(5) NOT NULL ,
  `account_server_section` CHAR(5) NOT NULL ,
  `account_server_id` CHAR(5) NOT NULL ,
  `server_name` CHAR(32) NOT NULL ,
  `server_ip` CHAR(32) NOT NULL ,
  `server_port` INT(11) NOT NULL ,
  `server_game_ip` CHAR(32) NOT NULL ,
  `server_game_port` INT(11) NOT NULL ,
  `server_message_ip` CHAR(32) NOT NULL ,
  `server_message_port` INT(11) NOT NULL ,
  `team_server` CHAR(32) NOT NULL ,
  `team_server_port` INT(11) NOT NULL ,
  `starwar_server` CHAR(32) NOT NULL ,
  `starwar_server_port` INT(11) NOT NULL ,
  `server_max_player` INT(11) NOT NULL DEFAULT '0' ,
  `account_count` INT(11) NOT NULL DEFAULT '0' ,
  `server_language` CHAR(16) NULL DEFAULT NULL ,
  `server_sort` INT(11) NOT NULL DEFAULT '0' ,
  `server_recommend` TINYINT(1) NOT NULL DEFAULT '0' ,
  `server_mode` ENUM('debug','normal','partner') NOT NULL DEFAULT 'normal' ,
  PRIMARY KEY (`game_id`, `account_server_section`, `account_server_id`) ,
  INDEX `server_recommend` USING BTREE (`server_recommend` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;

USE `platform_content_db` ;

-- -----------------------------------------------------
-- Placeholder table for view `platform_content_db`.`web_auto_template`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_content_db`.`web_auto_template` (`template_id` INT, `template_name` INT, `template_content` INT, `template_subject` INT, `template_reader` INT, `smtp_host` INT, `smtp_user` INT, `smtp_pass` INT, `smtp_from` INT, `smtp_fromName` INT, `auto_id` INT, `auto_template_id` INT, `auto_actived` INT, `auto_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `platform_content_db`.`web_news_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_content_db`.`web_news_view` (`channel_id` INT, `channel_name` INT, `channel_url` INT, `channel_father_id` INT, `channel_web_id` INT, `news_id` INT, `news_title` INT, `news_channel_id` INT, `news_intro` INT, `news_content` INT, `news_posttime` INT, `news_top_show` INT, `news_tags` INT, `news_keywords` INT, `news_description` INT, `news_display_title` INT, `news_status` INT, `news_display_pic` INT);

-- -----------------------------------------------------
-- Placeholder table for view `platform_content_db`.`web_notice_sender`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_content_db`.`web_notice_sender` (`notice_id` INT, `notice_content` INT, `notice_endtime` INT, `notice_posttime` INT, `notice_visible` INT, `notice_sender_id` INT, `notice_reciever_id` INT, `GUID` INT, `user_name` INT, `user_pass` INT, `user_permission` INT, `user_founder` INT, `user_freezed` INT, `additional_permission` INT);

-- -----------------------------------------------------
-- Placeholder table for view `platform_content_db`.`web_user_permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_content_db`.`web_user_permission` (`GUID` INT, `user_name` INT, `user_pass` INT, `user_permission` INT, `user_founder` INT, `user_freezed` INT, `additional_permission` INT, `permission_id` INT, `permission_name` INT, `permission_list` INT);

-- -----------------------------------------------------
-- Placeholder table for view `platform_content_db`.`server_list_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platform_content_db`.`server_list_view` (`game_id` INT, `account_server_section` INT, `account_server_id` INT, `server_name` INT, `server_ip` INT, `server_port` INT, `server_message_ip` INT, `server_message_port` INT, `server_max_player` INT, `account_count` INT, `server_language` INT, `server_recommend` INT, `section_name` INT, `game_name` INT, `game_version` INT, `game_platform` INT, `auth_key` INT, `game_pic_small` INT, `game_pic_middium` INT, `game_pic_big` INT, `game_download_iphone` INT, `game_download_ipad` INT, `game_status` INT, `server_mode` INT);

-- -----------------------------------------------------
-- View `platform_content_db`.`web_auto_template`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `platform_content_db`.`web_auto_template` ;
DROP TABLE IF EXISTS `platform_content_db`.`web_auto_template`;
USE `platform_content_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `platform_content_db`.`web_auto_template` AS select `platform_content_db`.`web_mail_template`.`template_id` AS `template_id`,`platform_content_db`.`web_mail_template`.`template_name` AS `template_name`,`platform_content_db`.`web_mail_template`.`template_content` AS `template_content`,`platform_content_db`.`web_mail_template`.`template_subject` AS `template_subject`,`platform_content_db`.`web_mail_template`.`template_reader` AS `template_reader`,`platform_content_db`.`web_mail_template`.`smtp_host` AS `smtp_host`,`platform_content_db`.`web_mail_template`.`smtp_user` AS `smtp_user`,`platform_content_db`.`web_mail_template`.`smtp_pass` AS `smtp_pass`,`platform_content_db`.`web_mail_template`.`smtp_from` AS `smtp_from`,`platform_content_db`.`web_mail_template`.`smtp_fromName` AS `smtp_fromName`,`platform_content_db`.`web_mail_autosend`.`auto_id` AS `auto_id`,`platform_content_db`.`web_mail_autosend`.`auto_template_id` AS `auto_template_id`,`platform_content_db`.`web_mail_autosend`.`auto_actived` AS `auto_actived`,`platform_content_db`.`web_mail_autosend`.`auto_name` AS `auto_name` from (`platform_content_db`.`web_mail_template` join `platform_content_db`.`web_mail_autosend`) where (`platform_content_db`.`web_mail_autosend`.`auto_template_id` = `platform_content_db`.`web_mail_template`.`template_id`);

-- -----------------------------------------------------
-- View `platform_content_db`.`web_news_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `platform_content_db`.`web_news_view` ;
DROP TABLE IF EXISTS `platform_content_db`.`web_news_view`;
USE `platform_content_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `platform_content_db`.`web_news_view` AS select `platform_content_db`.`web_channels`.`channel_id` AS `channel_id`,`platform_content_db`.`web_channels`.`channel_name` AS `channel_name`,`platform_content_db`.`web_channels`.`channel_url` AS `channel_url`,`platform_content_db`.`web_channels`.`channel_father_id` AS `channel_father_id`,`platform_content_db`.`web_channels`.`channel_web_id` AS `channel_web_id`,`platform_content_db`.`web_news`.`news_id` AS `news_id`,`platform_content_db`.`web_news`.`news_title` AS `news_title`,`platform_content_db`.`web_news`.`news_channel_id` AS `news_channel_id`,`platform_content_db`.`web_news`.`news_intro` AS `news_intro`,`platform_content_db`.`web_news`.`news_content` AS `news_content`,`platform_content_db`.`web_news`.`news_posttime` AS `news_posttime`,`platform_content_db`.`web_news`.`news_top_show` AS `news_top_show`,`platform_content_db`.`web_news`.`news_tags` AS `news_tags`,`platform_content_db`.`web_news`.`news_keywords` AS `news_keywords`,`platform_content_db`.`web_news`.`news_description` AS `news_description`,`platform_content_db`.`web_news`.`news_display_title` AS `news_display_title`,`platform_content_db`.`web_news`.`news_status` AS `news_status`,`platform_content_db`.`web_news`.`news_display_pic` AS `news_display_pic` from (`platform_content_db`.`web_channels` join `platform_content_db`.`web_news` on((`platform_content_db`.`web_channels`.`channel_id` = `platform_content_db`.`web_news`.`news_channel_id`)));

-- -----------------------------------------------------
-- View `platform_content_db`.`web_notice_sender`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `platform_content_db`.`web_notice_sender` ;
DROP TABLE IF EXISTS `platform_content_db`.`web_notice_sender`;
USE `platform_content_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `platform_content_db`.`web_notice_sender` AS select `a`.`notice_id` AS `notice_id`,`a`.`notice_content` AS `notice_content`,`a`.`notice_endtime` AS `notice_endtime`,`a`.`notice_posttime` AS `notice_posttime`,`a`.`notice_visible` AS `notice_visible`,`a`.`notice_sender_id` AS `notice_sender_id`,`a`.`notice_reciever_id` AS `notice_reciever_id`,`b`.`GUID` AS `GUID`,`b`.`user_name` AS `user_name`,`b`.`user_pass` AS `user_pass`,`b`.`user_permission` AS `user_permission`,`b`.`user_founder` AS `user_founder`,`b`.`user_freezed` AS `user_freezed`,`b`.`additional_permission` AS `additional_permission` from (`platform_content_db`.`web_private_notice` `a` join `platform_content_db`.`web_user` `b`) where (`a`.`notice_sender_id` = `b`.`GUID`);

-- -----------------------------------------------------
-- View `platform_content_db`.`web_user_permission`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `platform_content_db`.`web_user_permission` ;
DROP TABLE IF EXISTS `platform_content_db`.`web_user_permission`;
USE `platform_content_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `platform_content_db`.`web_user_permission` AS select `a`.`GUID` AS `GUID`,`a`.`user_name` AS `user_name`,`a`.`user_pass` AS `user_pass`,`a`.`user_permission` AS `user_permission`,`a`.`user_founder` AS `user_founder`,`a`.`user_freezed` AS `user_freezed`,`a`.`additional_permission` AS `additional_permission`,`b`.`permission_id` AS `permission_id`,`b`.`permission_name` AS `permission_name`,`b`.`permission_list` AS `permission_list` from (`platform_content_db`.`web_user` `a` join `platform_content_db`.`web_permission` `b`) where (`a`.`user_permission` = `b`.`permission_id`);

-- -----------------------------------------------------
-- View `platform_content_db`.`server_list_view`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `platform_content_db`.`server_list_view` ;
DROP TABLE IF EXISTS `platform_content_db`.`server_list_view`;
USE `platform_content_db`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `platform_content_db`.`server_list_view` AS select `platform_content_db`.`game_server`.`game_id` AS `game_id`,`platform_content_db`.`game_server`.`account_server_section` AS `account_server_section`,`platform_content_db`.`game_server`.`account_server_id` AS `account_server_id`,`platform_content_db`.`game_server`.`server_name` AS `server_name`,`platform_content_db`.`game_server`.`server_ip` AS `server_ip`,`platform_content_db`.`game_server`.`server_port` AS `server_port`,`platform_content_db`.`game_server`.`server_message_ip` AS `server_message_ip`,`platform_content_db`.`game_server`.`server_message_port` AS `server_message_port`,`platform_content_db`.`game_server`.`server_max_player` AS `server_max_player`,`platform_content_db`.`game_server`.`account_count` AS `account_count`,`platform_content_db`.`game_server`.`server_language` AS `server_language`,`platform_content_db`.`game_server`.`server_recommend` AS `server_recommend`,`platform_content_db`.`game_section`.`section_name` AS `section_name`,`platform_content_db`.`game_product`.`game_name` AS `game_name`,`platform_content_db`.`game_product`.`game_version` AS `game_version`,`platform_content_db`.`game_product`.`game_platform` AS `game_platform`,`platform_content_db`.`game_product`.`auth_key` AS `auth_key`,`platform_content_db`.`game_product`.`game_pic_small` AS `game_pic_small`,`platform_content_db`.`game_product`.`game_pic_middium` AS `game_pic_middium`,`platform_content_db`.`game_product`.`game_pic_big` AS `game_pic_big`,`platform_content_db`.`game_product`.`game_download_iphone` AS `game_download_iphone`,`platform_content_db`.`game_product`.`game_download_ipad` AS `game_download_ipad`,`platform_content_db`.`game_product`.`game_status` AS `game_status`,`platform_content_db`.`game_server`.`server_mode` AS `server_mode` from ((`platform_content_db`.`game_server` join `platform_content_db`.`game_section` on((`platform_content_db`.`game_server`.`account_server_section` = `platform_content_db`.`game_section`.`server_section_id`))) join `platform_content_db`.`game_product` on((`platform_content_db`.`game_server`.`game_id` = `platform_content_db`.`game_product`.`game_id`)));


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
