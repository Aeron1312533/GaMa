CREATE DATABASE gamingmanagement
USE gamingmanagement; 

CREATE TABLE IF NOT EXISTS `cat_sex` (
  `id_cat_sex` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_cat_sex PRIMARY KEY (id_cat_sex),
  CONSTRAINT uc_name_cat_sex UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS `player` (
  `id_player` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(150) NOT NULL,
  `id_cat_sex` int(2) unsigned NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_player PRIMARY KEY (id_player),
  CONSTRAINT uc_nickname_player UNIQUE (nickname),
  CONSTRAINT fk_id_cat_sex_player FOREIGN KEY (id_cat_sex)
    REFERENCES cat_sex(id_cat_sex) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `cat_game` (
  `id_cat_game` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_cat_game PRIMARY KEY (id_cat_game),
  CONSTRAINT uc_name_cat_game UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS `league` (
  `id_league` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `valid_from` timestamp NULL,
  `valid_to` timestamp NULL,
  `id_cat_game` int(2) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_league PRIMARY KEY (id_league),
  CONSTRAINT uc_name_league UNIQUE (name),
  CONSTRAINT fk_id_cat_game_league FOREIGN KEY (id_cat_game)
    REFERENCES cat_game(id_cat_game) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `cat_tournament_status` (
  `id_cat_tournament_status` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_cat_tournament_status PRIMARY KEY (id_cat_tournament_status),
  CONSTRAINT uc_name_cat_tournament_status UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS `tournament` (
  `id_tournament` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `id_cat_tournament_status` int(2) unsigned NOT NULL,
  `id_cat_game` int(2) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_tournament PRIMARY KEY (id_tournament),
  CONSTRAINT uc_name_tournament UNIQUE (name),
  CONSTRAINT fk_id_cat_game_tournament FOREIGN KEY (id_cat_game)
    REFERENCES cat_game(id_cat_game) ON DELETE RESTRICT,
  CONSTRAINT fk_id_cat_tournament_status_tournament FOREIGN KEY (id_cat_tournament_status)
    REFERENCES cat_tournament_status(id_cat_tournament_status) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `team` (
  `id_team` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_team PRIMARY KEY (id_team)
);

CREATE TABLE IF NOT EXISTS `result_match` (
  `id_result_match` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_team_winner` int(10) unsigned NULL,
  `id_team_loser` int(10) unsigned NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_result_match PRIMARY KEY (id_result_match),
  CONSTRAINT fk_id_team_winner_result_match FOREIGN KEY (id_team_winner)
    REFERENCES team(id_team) ON DELETE SET NULL,
  CONSTRAINT fk_id_team_loser_result_match FOREIGN KEY (id_team_loser)
    REFERENCES team(id_team) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `match` (
  `id_match` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_result_match` int(10) unsigned NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL,
  CONSTRAINT pk_match PRIMARY KEY (id_match),
  CONSTRAINT fk_id_result_match_match FOREIGN KEY (id_result_match)
    REFERENCES result_match(id_result_match) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `match_league` (
  `id_match_league` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_match` int(10) unsigned NOT NULL,
  `id_league` int(10) unsigned NOT NULL,
  CONSTRAINT pk_match_league PRIMARY KEY (id_match_league),
  CONSTRAINT fk_id_match_match_league FOREIGN KEY (id_match)
    REFERENCES `match`(id_match) ON DELETE CASCADE,
  CONSTRAINT fk_id_league_match_league FOREIGN KEY (id_league)
    REFERENCES league(id_league) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `match_tournament` (
  `id_match_tournament` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_match` int(10) unsigned NOT NULL,
  `id_tournament` int(10) unsigned NOT NULL,
  CONSTRAINT pk_match_tournament PRIMARY KEY (id_match_tournament),
  CONSTRAINT fk_id_match_match_tournament FOREIGN KEY (id_match)
    REFERENCES `match`(id_match) ON DELETE CASCADE,
  CONSTRAINT fk_id_tournament_match_tournament FOREIGN KEY (id_tournament)
    REFERENCES tournament(id_tournament) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `match_friendly` (
  `id_match_friendly` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_match` int(10) unsigned NOT NULL,
  CONSTRAINT pk_match_friendly PRIMARY KEY (id_match_friendly),
  CONSTRAINT fk_id_match_match_friendly FOREIGN KEY (id_match)
    REFERENCES `match`(id_match) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `r_player_match` (
  `id_player` int(10) unsigned NOT NULL,
  `id_match` int(10) unsigned NOT NULL,
  `id_team` int(10) unsigned NULL,
  `score` int(10) unsigned NOT NULL,
  CONSTRAINT pk_r_player_match PRIMARY KEY (id_player, id_match),
  CONSTRAINT fk_id_player_r_player_match FOREIGN KEY (id_player)
    REFERENCES player(id_player) ON DELETE CASCADE,
  CONSTRAINT fk_id_match_r_player_match FOREIGN KEY (id_match)
    REFERENCES `match`(id_match) ON DELETE CASCADE,
  CONSTRAINT fk_id_team_r_player_match FOREIGN KEY (id_team)
    REFERENCES team(id_team) ON DELETE SET NULL
);