create table `2020_pneumonia`
(
    last_since datetime null,
    proved     int      null,
    uncertain  int      null,
    died       int      null,
    cured      int      null
);

INSERT INTO web.`2020_pneumonia` (last_since, proved, uncertain, died, cured) VALUES ('2020-02-09 19:10:00', 37287, 28942, 813, 2873);
INSERT INTO web.`2020_pneumonia` (last_since, proved, uncertain, died, cured) VALUES ('2020-02-09 21:32:00', 37289, 28942, 813, 2898);
INSERT INTO web.`2020_pneumonia` (last_since, proved, uncertain, died, cured) VALUES ('2020-02-09 22:55:00', 37289, 28942, 813, 2898);