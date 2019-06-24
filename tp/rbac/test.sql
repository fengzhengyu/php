-- mysql> desc ddyk_admin;  用户表
-- +-----------+--------------+------+-----+---------+----------------+
-- | Field     | Type         | Null | Key | Default | Extra          |
-- +-----------+--------------+------+-----+---------+----------------+
-- | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
-- | adminName | varchar(255) | NO   |     | NULL    |                |
-- | password  | varchar(255) | NO   |     | NULL    |                |
-- | status    | tinyint(255) | YES  |     | 1       |                |
-- | groupId   | int(11)      | YES  |     | NULL    |                |
-- | name      | varchar(255) | YES  |     | NULL    |                |
-- +-----------+--------------+------+-----+---------+----------------+

-- mysql> desc ddyk_admin_group; 用户组表
-- +-----------+--------------+------+-----+---------+----------------+
-- | Field     | Type         | Null | Key | Default | Extra          |
-- +-----------+--------------+------+-----+---------+----------------+
-- | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
-- | groupName | varchar(255) | NO   |     | NULL    |                |
-- +-----------+--------------+------+-----+---------+----------------+

-- mysql> desc ddyk_admin_relation; 用户关系表
-- +----------+---------+------+-----+---------+----------------+
-- | Field    | Type    | Null | Key | Default | Extra          |
-- +----------+---------+------+-----+---------+----------------+
-- | id       | int(11) | NO   | PRI | NULL    | auto_increment |
-- | groupId  | int(11) | NO   |     | NULL    |                |
-- | sourceId | int(11) | NO   |     | NULL    |                |
-- +----------+---------+------+-----+---------+----------------+

-- mysql> desc ddyk_admin_resource; 用户权限表
-- +--------------+--------------+------+-----+---------+----------------+
-- | Field        | Type         | Null | Key | Default | Extra          |
-- +--------------+--------------+------+-----+---------+----------------+
-- | id           | int(11)      | NO   | PRI | NULL    | auto_increment |
-- | resourceName | varchar(255) | YES  |     | NULL    |                |
-- | model        | varchar(255) | YES  |     | NULL    |                |
-- | action       | varchar(255) | YES  |     | NULL    |                |
-- +--------------+--------------+------+-----+---------+----------------+