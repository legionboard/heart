<?php
/*
 * Copyright (C) 2016 - 2017 Nico Alt
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * See the file "LICENSE.md" for the full license governing this code.
 * 
 * DELETE AFTER USAGE!!!
 *
 * Create a randomly named directory in the project (where `api.php`,
 * `index.html`, etc. is) and place this script in it.
 */
// Set UTF-8
header("Content-Type: text/html; charset=utf-8");
$username = $_POST['username'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];
$groups = $_POST['groups'];

try {
    // Include authentication
    require '../LegionBoard/Authentication.php';
    $authentication = new \LegionBoard\Authentication();

    // Check if strings are "POSTed"
    if (empty($username) && empty($password) && empty($groups)) {
        throw new Exception();
    }

    // Check if strings are not empty
    if ($username == '' || $password == '' || $groups == '') {
        throw new Exception("Please check the fields.");
    }

    // Check if passwords are equal
    if ($password != $password_repeat) {
        throw new Exception("The passwords are not equal!");
    }

    // Create key
    $key = hash('sha256', strtolower(trim($username)) . '//' . trim($password));
    if (!$authentication->create($key, $groups, $username)) {
        throw new Exception("Could not add the key.");
    }

    // Print out message with details
    $msg = "Key added successfully.";
} catch (Exception $e) {
    $msg = $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Creation Tool</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
    </head>
    <body>
        <h1>DELETE AFTER USAGE!!!</h1>
        <p><b><?=$msg?></b></p>
        <form method="post" accept-charset="UTF-8">
            <p><input type="text" name="username" placeholder="Username" value="<?=$username?>" required/></p>
            <p><input type="password" name="password" placeholder="Password" value="<?=$password?>" required/></p>
            <p><input type="password" name="password_repeat" placeholder="Repeat password" value="<?=$password_repeat?>" required/></p>
            <p><input type="text" name="groups" placeholder="Groups (comma separated)" value="<?=$groups?>" required/></p>
            <p><input type="submit" /></p>
        </form>
        <p>Groups:</p>
        <p>%: All groups</p>
        <p>0: See changes</p>
        <p>1: Add change</p>
        <p>2: Update change</p>
        <p>3: Delete change</p>
        <p>4: See teachers</p>
        <p>5: Add teacher</p>
        <p>6: Update teacher</p>
        <p>7: Delete teacher</p>
        <p>8: See reasons</p>
        <p>9: See private texts</p>
        <p>10: See courses</p>
        <p>11: Add course</p>
        <p>12: Update course</p>
        <p>13: Delete course</p>
        <p>14: See times (added, edited)</p>
        <p>15: See activities</p>
        <p>16: See subjects</p>
        <p>17: Add subject</p>
        <p>18: Update subject</p>
        <p>19: Delete subject</p>
        <p>20: Export all resources</p>
    </body>
</html>
