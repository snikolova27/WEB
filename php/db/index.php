<?php
$host = 'localhost';
$type = 'mysql';
$name = 'wtech23'; // тази база си я създаваме през phpMyAdmin пак от XAMPP
$user = 'root';
$password = '';


$connection = new PDO("$type:host=$host;dbname=$name", $user, $password);
// Това стои тука, за да може да се ролбакне в catch-a
$connection->beginTransaction();

try {
    // Create users table if it DOES NOT exist already

    //     $createUsersTable = 'CREATE TABLE `users` (

    //         id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    // 	    name VARCHAR(100) NOT NULL,

    // 	    email VARCHAR(100) NOT NULL,

    // 	    PRIMARY KEY (id),

    // 	    UNIQUE (email)

    // );';

    //     $connection->query($createUsersTable);


    // If the users table exists and the students table DOES NOT

    // $createStudentsTable = 'CREATE TABLE students(
    //         first_name VARCHAR(50) NOT NULL,
    //         last_name VARCHAR(50) NOT NULL,
    //         fn INT NOT NULL,
    //         user_id INT UNSIGNED NOT NULL,
    //         PRIMARY KEY (fn),
    //         FOREIGN KEY (user_id) REFERENCES users(id)
    //     )';


    // $connection->query($createStudentsTable);

    // Insert first dummy user if it does not exist already
    // $insertUserIvan = 'INSERT INTO users(name, email) VALUES("Makaron", "makaron@gmail.com")';

    // $result = $connection->query($insertUserIvan);

    // Insert student if it does not exist already
    // $insertIntoStudents = 'INSERT INTO students(first_name, last_name, fn, user_id) VALUES("Makaron", "Makaronena", 88888, 15)';
    // // Моето е айди е 15, щото оплесках нещата няколко пъти ОЧЕВИДНО 
    //  $connection->query($insertIntoStudents);

    $selectAllFromUsers = 'SELECT * FROM users';
        echo "<br/>";
    echo "All users:";
    echo "<br/>";

    $allUsers = $connection->query($selectAllFromUsers);
    var_dump($allUsers->fetchAll(PDO::FETCH_NUM));

    echo "<br/>";
    echo "<br/>";

    $selectAllFromStudents = 'SELECT * FROM students';
    echo "All students:";
    echo "<br/>";

    $allStudents = $connection->query($selectAllFromStudents);
    var_dump($allStudents->fetchAll(PDO::FETCH_NUM));

    $prepared_insert_user_sql =  'INSERT INTO users(name, email) VALUES(?, ?)';
    $prepared_insert_student_sql = 'INSERT INTO students(first_name, last_name, fn, user_id) VALUES(?, ?, ?, ?)';

    $prepared_users = $connection->prepare($prepared_insert_user_sql);
    $prepared_students = $connection->prepare($prepared_insert_student_sql);

    // Execute if these users do not exist already
    // $prepared_users->execute(['Dimitar', 'Dimitrov']);
    // $prepared_users->execute(['Maria', 'Georgieva']);

    
    // Execute if these students do not exist already
    // $prepared_students->execute(['Dimitar', 'Dimitrov', 888795, 16]); // при първо пускане, тези ще са 2 и 3
    // $prepared_students->execute(['Maria', 'Georgieva', 888786, 17]);

    echo "<br/>";
    echo "<br/>";
    echo "All users:";
    echo "<br/>";

    // PDO::FETCH_ASSOC ги изкарва по-хубаво, с имената на колоните
    $allUsers = $connection->query($selectAllFromUsers);
    var_dump($allUsers->fetchAll(PDO::FETCH_ASSOC));

    echo "<br/>";
    echo "<br/>";
    echo "All students:";
    echo "<br/>";

    $allStudents = $connection->query($selectAllFromStudents);
    var_dump($allStudents->fetchAll(PDO::FETCH_ASSOC));


    $prepared_update_users = 'UPDATE users SET email=:email WHERE id=:id';
    $prepared_update_users = $connection->prepare($prepared_update_users);
    $prepared_update_users->execute(['email' => 'new_email@gmail.com', 'id' => 15]); //тука пак ще е 2

    echo "<br/>";
    echo "<br/>";
    echo "All users:";
    echo "<br/>";

    $allUsers = $connection->query($selectAllFromUsers);
    var_dump($allUsers->fetchAll(PDO::FETCH_ASSOC));

    echo "<br/>";
    echo "<br/>";
    echo "All students:";
    echo "<br/>";

    $allStudents = $connection->query($selectAllFromStudents);
    var_dump($allStudents->fetchAll(PDO::FETCH_ASSOC));

    $connection->commit();
} catch (Exception $error) {
    $connection->rollBack();
    echo $error;
}
