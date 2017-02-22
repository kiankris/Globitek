# Project 4 - Globitek Authentication and Login Throttling

Time spent: 6 hours spent in total

## User Stories

The following **required** functionality is completed:

1\. [X]  Required: Test for initial vulnerabilities

2\. [X]  Required: Configure sessions
  * [X]  Required: Only allow session IDs to come from cookies
  * [X]  Required: Expire after one day
  * [X]  Required: Use cookies which are marked as HttpOnly

3\. [X]  Required: Complete Login page.
  * [X]  Required: Show an error message when username is not found.
  * [X]  Required: Show an error message when username is found but password does not match.
  * [X]  Required: After login, store user ID in session data.
  * [X]  Required: After login, store user last login time in session data.
  * [X]  Required: Regenerate the session ID at the appropriate point.

4\. [X]  Required: Require login to access staff area pages: The pages that were excluded were the states/index and territories/index pages.
  * [X]  Required: Add a login requirement to *almost all* staff area pages.
  * [X]  Required: Write code for `last_login_is_recent()`.

5\. [X]  Required: Complete Logout page.
  * [X]  Required: Add code to destroy the user's session file after logging out.

6\. [X]  Required: Add CSRF protections to the state forms.
  * [X]  Required: Create a CSRF token.
  * [X]  Required: Add CSRF tokens to forms.
  * [X]  Required: Compare tokens against the stored version of the token.
  * [X]  Required: Only process forms data sent by POST requests.
  * [X]  Required: Confirm request referer is from the same domain as the host.
  * [X]  Required: Store the CSRF token in the user's session.
  * [X]  Required: Add the same CSRF token to the login form as a hidden input.
  * [X]  Required: When submitted, confirm that session and form tokens match.
  * [X]  Required: If tokens do not match, show an error message.
  * [X]  Required: Make sure that a logged-in user can use pages as expected.

7\. [X]  Required: Ensure the application is not vulnerable to XSS attacks.

8\. [X]  Required: Ensure the application is not vulnerable to SQL Injection attacks.

9\. [X]  Required: Run all tests from Objective 1 again and confirm that your application is no longer vulnerable to any test.


The following advanced user stories are optional and were completed:

* [X]  Bonus Objective 1: Identify security flaw in Objective #4 (requiring login on staff pages)
  The security principle not being followed is security through obscurity. Giving a different error message between invalid usernames and invalid usernames && passwords lets an attacker know that they are closer to breaking into the website. The code should give the same error message between the two cases. For my code the result of either value being incorrect causes the error message "Username and password combination is invalid" to be displayed.

* [X] Bonus Objective 2: Add CSRF protections to all forms in the staff directory

* [X]  Bonus Objective 3: CSRF tokens only valid for 10 minutes.

* [X]  Bonus Objective 4: Sessions are valid only if user-agent string matches previous value.

* [X]  Advanced Objective: Set/Get Signed-Encrypted Cookie
  * [X]  Create "public/set\_secret\_cookie.php".
  * [X]  Create "public/get\_secret\_cookie.php".
  * [X]  Encrypt and sign cookie before storing.
  * [X]  Verify cookie is signed correctly or show error message.
  * [X]  Decrypt cookie.

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='https://github.com/kiankris/Globitek-CMS-Authentication/blob/master/demo.gif' title='Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Installing php7.1.2 was probably the hardest part of this assignment as it did not immediately work with WAMPSERVER and few error messages were given on WAMP's part to determine what went wrong. The second hardest part was implementing the sessions as I found it difficult to determine what was working and what was not. Other than these two issues the assignment overall was very simple but worth the experience of reading up on sessions/cookies/WAMP.

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
