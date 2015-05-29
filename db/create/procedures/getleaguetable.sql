DELIMITER ;;
CREATE PROCEDURE GetLeagueTable(IN id_league INT)
BEGIN
    SELECT
	p.nickname,
	COUNT(*) AS 'matches',
	SUM(IF(rpm.id_team = rm.id_team_winner, 1, 0)) AS 'wins',
	SUM(IF(rpm.id_team = rm.id_team_winner, 0, 1)) AS 'loses',
	SUM(rpm.score) AS 'score',
	SUM(IF(rpm.id_team = rm.id_team_winner, 1, 0)) AS 'points'
    FROM r_player_match AS rpm
	INNER JOIN `match` AS m
		ON m.id_match = rpm.id_match
	INNER JOIN match_league AS ml
		ON ml.id_match = rpm.id_match
	INNER JOIN team AS t
		ON t.id_team = rpm.id_team
	INNER JOIN result_match AS rm
		ON rm.id_result_match = m.id_result_match
	INNER JOIN player AS p
		ON rpm.id_player = p.id_player
    WHERE m.flag_test = 0
        AND ml.id_league = id_league
    GROUP BY p.nickname;
END;;
DELIMITER ;