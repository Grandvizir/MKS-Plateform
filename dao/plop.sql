SELECT TaskID, UserID, UName, Tdescription
FROM `product`, `sprint`, `task`, `user`
AND `user`.UserID = `task`.UserID
AND `sprint`.SprintID = `task`.SprintID





SELECT TaskID, `user`.UserID, `user`.UName, Tdescription
FROM `usertask`, `sprint`, `task`, `user`
WHERE `usertask`.SprintID = `task`.SprintID
AND `user`.UserID = `usertask`.UserID
AND `sprint`.SprintID = `task`.SprintID




SELECT *
FROM `product`, `sprint`, `task`, `user`
RIGHT JOIN (SELECT DISTINCT `task`.tASKid FROM `task`) AS TR
ON `product`.ProductID = `sprint`.ProductID
AND `sprint`.SprintID = `task`.SprintID
AND `product`.ProductID = :productID


SELECT *
FROM `product`, `sprint`, `task`, `user`
where `product`.ProductID = `sprint`.ProductID
AND `sprint`.SprintID = `task`.SprintID
AND `product`.ProductID = :productID






INSERT INTO task ()
