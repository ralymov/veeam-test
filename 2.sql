--  MySQL. В таблице хранятся целые числа, отсортированные по возрастанию, некоторые были удалены.
--  Найдите второе пропущенное число.

WITH RECURSIVE all_numbers AS
                   (SELECT 1 AS number
                    UNION ALL
                    SELECT number + 1
                    FROM all_numbers
                    WHERE number <
                          (SELECT MAX(id)
                           FROM users))
SELECT *
FROM all_numbers
    EXCEPT
SELECT id
FROM users
ORDER BY number LIMIT 1, 1;