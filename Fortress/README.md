# Project 10 - Fortress Globitek

Time spent: **2** hours spent in total

> Objective: Create an intentionally vulnerable version of the Globitek application with a secret that can be stolen.

### Requirements

- [X] All source code and assets necessary for running app (except for db_credentials.php which the user needs to make in order to interact with their own database) are provided`
- [X] `/globitek.sql` containing all required SQL, including the `secrets` table
- [X] GIF Walkthrough of compromise
- [X] Brief writeup about the vulnerabilities introduced below

### Vulnerabilities

The public/staff/users/new.php page is not protected through the require_login() function. The update salesperson function does not escape the provided first_name field of the salesperson that is being edited. An attacker can create a new user as it does not require a login, afterwards the attacker can login to the website and go to the public/staff/salespeople/edit.php page and perform a sql injection to steal the secret.

### Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='https://github.com/kiankris/Globitek/blob/master/Fortress/Vulnerability.gif' title='Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).
