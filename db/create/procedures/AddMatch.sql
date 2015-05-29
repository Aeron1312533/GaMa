DELIMITER $$

DROP PROCEDURE IF EXISTS AddMatch$$


CREATE PROCEDURE AddMatch(
    IN player1 INT(10),
    IN player2 INT(10),
    IN player1score INT(10),
    IN player2score INT(10),
    IN note TEXT,
    OUT id_match INT
)
 BEGIN
    DECLARE id_team_1 INT DEFAULT 0;
    DECLARE id_team_2 INT DEFAULT 0;
    DECLARE id_team_winner INT DEFAULT 0;
    DECLARE id_team_loser INT DEFAULT 0;
    DECLARE id_result_match INT DEFAULT 0;
        
    INSERT INTO team(name)
    VALUES("team1");
    
    SET id_team_1 = LAST_INSERT_ID();
    
    INSERT INTO team(name)
    VALUES("team2");
    
     SET id_team_2 = LAST_INSERT_ID();
     
     IF (player1score > player2score) THEN
        SET id_team_winner = id_team_1;
        SET id_team_loser = id_team_2;
     ELSE
        SET id_team_winner = id_team_2;
        SET id_team_loser = id_team_1;
     END IF;
     
     INSERT INTO result_match(id_team_winner, id_team_loser)
     VALUES(id_team_winner, id_team_loser);

     SET id_result_match = LAST_INSERT_ID();

     INSERT INTO `match`(id_result_match, note)
     VALUES (id_result_match, note);

     SET id_match = LAST_INSERT_ID();

     INSERT INTO r_player_match(id_player, id_match, id_team, score)
     VALUES(player1, id_match, id_team_1, player1score);

     INSERT INTO r_player_match(id_player, id_match, id_team, score)
     VALUES(player2, id_match, id_team_2, player2score);
 END$$
