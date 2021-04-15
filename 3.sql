# MySQL. Есть таблица сотрудников: name, job title, salary. Вывести сотрудников, чья
# зарплата выше средней среди каждого job title, не используя группировку и подзапросы.

# БЕЗ группировки и подзапросов

CREATE TEMPORARY TABLE average_salaries
SELECT name,
       job_title,
       AVG(salary) OVER (PARTITION BY job_title) AS avg_salary
FROM employees;

SELECT e.name,
       e.job_title,
       e.salary
FROM employees e
         JOIN average_salaries avs ON e.job_title = avs.job_title
    AND e.name = avs.name
WHERE e.salary > avs.avg_salary;

# Вариант без ограничений

SELECT name,
       job_title,
       salary
FROM employees e
WHERE salary >
      (SELECT avg(salary)
       FROM employees e2
       WHERE e2.job_title = e.job_title);