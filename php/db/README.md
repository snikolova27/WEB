## Guide for creating the database used

Checkout [this](https://webtech.w3c.fmi.uni-sofia.bg/w15labs/PHP-SQL.html?read=1#1). The name of the database is `wtech23` and you need to create it to begin.

You would also need a `users` table created like this. The creation is included in the [index.php](index.php), too. 

```sql
CREATE TABLE `users` (
        
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,

	    name VARCHAR(100) NOT NULL,

	    email VARCHAR(100) NOT NULL,

	    PRIMARY KEY (id),

	    UNIQUE (email)

);
```
