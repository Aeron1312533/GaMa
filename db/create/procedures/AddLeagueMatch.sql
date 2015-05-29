DELIMITER $$

DROP PROCEDURE IF EXISTS AddLeagueMatch$$

CREATE PROCEDURE AddLeagueMatch(
    IN player1 INT(10),
    IN player2 INT(10),
    IN player1score INT(10),
    IN player2score INT(10),
    IN id_league INT(10),
    IN note TEXT
)
 BEGIN
    DECLARE id_match INT DEFAULT 0;
        
    /*
     * Add match
     */

    CALL AddMatch(player1, player2, player1score, player2score, note, @id_match);

    INSERT INTO match_league (id_match, id_league)
    VALUES (@id_match, id_league);

    SELECT 1;

 END$$
