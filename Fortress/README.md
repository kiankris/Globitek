# Project 6 - Globitek Authentication and Login Throttling

Time spent: 8 hours spent in total

## User Stories

The following **required** functionality is completed:

1\. "staff/users/new.php" and "staff/users/edit.php"
  * [X]  Form with inputs for "Password" and "Confirm Password"
  * [X]  Strong password requirements text

2\. Data validations
  * [X]  Returns an error if password or confirm_password are blank.
  * [X]  Returns an error if password and confirm_password do not match.
  * [X]  Returns an error if password is not at least 12 characters long.
  * [X]  Returns an error if password does not meet character requirements.
  * [X]  Returns any errors related to other validations already on the user.

3\. Saving a user
  * [X]  Encrypts the password
  * [X]  Stores the password in the database

4\. Login page
  * [X]  Verify the correct password.
  * [X]  Do not create a User Enumeration vulnerability.

5\. If a user fails to log in:
  * [X]  Record the failed login for the first 5 attempts.
  * [X]  Return a "too many failed logins" message after 5 attempts.
  * [X]  Future attempts will show the number of minutes remaining in the lockout.
  * [X]  After the lockout period, the failed logins count resets to 0.

6\. After any successful login:
  * [X]  Set the failed_logins.count for the username to 0.

7\. SQLi and XSS
  * [X]  Do not introduce any SQLI Injection and Cross-Site Scripting vulnerabilities.

The following advanced user stories are optional:

* Bonus Objective 1\.
  * [X]  Identify the subtle Username Enumeration weakness. Include a short description of how the code could be modified to be more secure below:
	The weakness is that even though the error messages are the same, if the username exists the submitted password must be checked for validity as opposed to when the username does not exist and the password is not checked. If an attacker can time how long it takes to check the password vs when the password is not checked they can determine whether or not the username exists. A potential solution to this would be to check the password against a dummy password when the username is not found or to throttle the time it takes to log in.

* Bonus Objective 2\.
  * [X]  User password validations only run when the password is not blank.
  * [X]  `update_user` only encrypts and updates the password when the password is not blank.

* Bonus Objective 3\.
  * [X]  Create a new user using cost 10.
  * [X]  Set bcrypt "cost" parameter to 11 (for both insert and update).
  * [X]  Try to login with the "cost 10" user.
  * [X]  Briefly describe why login still works even after the cost is changed: The password_hash algorithm returns the algorithm, salt, and cost as part of the returned hash. Thus when password_verify is called on the password and hash it will extract the neeeded hashing algorithm, salt, and cost so that it can hash the given password and compare it to the given hash. 

* Bonus Objective 4\.
  * [X]  Add "Previous password" to "public/staff/users/edit.php"
  * [X]  Validate the previous password before allowing the password to be updated.
  * [X]  Require previous password only if new password is being updated (if also completing Bonus Objective 2).

* Advanced Objective 1\.
  * [X]  Implement `password_hash()` on your own as `my_password_hash()`.
  * [X]  Implement `password_verify()` on your own as `my_password_verify()`.

* Advanced Objective 2\.
  * [X]  Write `generate_strong_password()`
  * [X]  Add a suggestion for a 12-character strong password to the new and edit user pages.

## Video Walkthrough

<img src='https://github.com/kiankris/Globitek/blob/master/Authentication/AuthenticationDemo.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## License

    Copyright 2017 Kiankris Villagonzalo

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
