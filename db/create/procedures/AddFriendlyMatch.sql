DELIMITER $$

DROP PROCEDURE IF EXISTS AddFriendlyMatch$$

CREATE PROCEDURE AddFriendlyMatch(
    IN player1 INT(10),
    IN player2 INT(10),
    IN player1score INT(10),
    IN player2score INT(10),
    IN note TEXT
)
 BEGIN
    DECLARE id_match INT DEFAULT 0;
        
    /*
     * Add match
     */

    CALL AddMatch(player1, player2, player1score, player2score, note, @id_match);

    INSERT INTO match_friendly (id_match)
    VALUES (@id_match);

    SELECT 1;

 END$$
