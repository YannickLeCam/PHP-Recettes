SELECT *
FROM recipe
WHERE timecook = (
    SELECT MIN(timecook)
    FROM recipe
  );