DELIMITER ;;
CREATE PROCEDURE GetLeagueMatches(IN id_league INT)
BEGIN

DECLARE loop_finished INTEGER DEFAULT 0;

DECLARE id_match INT DEFAULT 0;
DECLARE who_match VARCHAR(150) DEFAULT "";
DECLARE match_result VARCHAR(50) DEFAULT "";
DECLARE date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP;


DECLARE matches_cur CURSOR FOR
    SELECT
	rpm.id_match,
	CONCAT(p.nickname, " vs. ",
            (
        	SELECT p2.nickname
                FROM r_player_match AS rpm2
                	INNER JOIN player AS p2
                        	ON p2.id_player = rpm2.id_player
                WHERE rpm2.id_match = rpm.id_match
                	AND rpm2.id_player <> rpm.id_player
                LIMIT 1
            )
        ) AS 'Match',  
       CONCAT(rpm.score, " : ",
            (
        	SELECT rpm2.score
                FROM r_player_match AS rpm2
                	INNER JOIN player AS p2
                        	ON p2.id_player = rpm2.id_player
                WHERE rpm2.id_match = rpm.id_match
                	AND rpm2.id_player <> rpm.id_player
                LIMIT 1
            )
        ) AS 'Result',
        m.date_created
    FROM r_player_match AS rpm
	INNER JOIN player AS p
        	ON p.id_player = rpm.id_player
        INNER JOIN team AS t
        	ON t.id_team = rpm.id_team
        INNER JOIN `match` AS m
        	ON m.id_match = rpm.id_match
        INNER JOIN result_match AS rm
        	ON m.id_result_match = rm.id_result_match
    ORDER BY id_match;

 DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET loop_finished = 1;
        
CREATE TEMPORARY TABLE Matches (
    id_match INT UNIQUE, 
    who_match VARCHAR(150),
    match_result VARCHAR(50),
    date_created TIMESTAMP
); 

    OPEN matches_cur;

    get_match: LOOP
 
    FETCH matches_cur INTO id_match, who_match, match_result, date_created;
 
    IF loop_finished = 1 THEN 
        LEAVE get_match;
    END IF;
 
    -- build email list
    INSERT IGNORE INTO matches (id_match, who_match, match_result, date_created)
    VALUES( id_match, who_match, match_result, date_created);

 
 END LOOP get_match;

SELECT *
FROM matches
ORDER BY id_match DESC;

DROP TABLE matches;

END;;
DELIMITER ;