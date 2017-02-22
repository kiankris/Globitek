# Project 2: Globitek-CMS-Sanitization

Time spent: 24 hours spent in total

## User Stories

The following **required** functionality is completed:

1\. Required: Import the Starting Database

2\. Required: Set Up the Starting Code

3\. Required: Review code for Staff CMS for Users

4\. Required: Complete Staff CMS for Salespeople
  * [ ]  Required: index.php --- Will display the list of salespeople ordered by lastname, firstname. Clickable links include a "Back to Menu" which will return users to the main menu, "Add a Salesperson", "Show", "Edit" which will direct users to new, show, and edit pages.
  * [ ]  Required: show.php --- Will display the selected Salesperson's information, with an "edit" link to direct users to the edit page.
  * [ ]  Required: new.php --- Will allow users to input first and last names, phone number and email to create a salesperson. Includes a "Back to Salespeople List" link to send them to index page of salespeople, and a "create" button for form submission
  * [ ]  Required: edit.php --- Will display form values of the user that is being edited. Includes a "cancel" link that will redirect users to the show page for the salesperson, a "Back to Salespeople List" link to direct users to the index page and an "Update" button to submit form values

5\. Required: Complete Staff CMS for States
  * [ ]  Required: index.php --- Will display the list of states ordered by name. Clickable links include a "Back to Menu" which will return users to the main menu, "Add a State", "Show", "Edit" which will direct users to new, show, and edit pages.
  * [ ]  Required: show.php --- Will display the selected state's information, with an "edit" link to direct users to the edit page. Additionally displays a list of Territories that are associated with the state, with an "Add a Territory" link that directs users to the new.php page for territories. 
  * [ ]  Required: new.php --- Will allow users to input a name for a state and its code. Includes a "Back to States List" link to send them to index page of salespeople, and a "Create" button for form submission
  * [ ]  Required: edit.php --- Will display form values of the state that is being edited. Includes a "cancel" link that will redirect users to the show page for the state, a "Back to States List" link to direct users to the index page and an "Update" button to submit form values

6\. Required: Complete Staff CMS for Territories
  * [ ]  Required: index.php --- Will redirect users to the main menu.
  * [ ]  Required: show.php --- Will display the selected territory's information, with an "edit" link to direct users to the edit page. Includes a "Back to State Details" and "Edit" link.
  * [ ]  Required: new.php --- Will allow users to input a name for a territory and its position. Includes a "Back to State Details" link to send them to the show page of the state it was being added to, and a "Create" button for form submission.
  * [ ]  Required: edit.php --- Will allow users to edit the name for a territory and its position. Includes a "Back to State Details" link to send them to the show page of the state it was being added to, a "Cancel" link to the show page of the territory, and a "Create" button for form submission.

7\. Required: Add Data Validations
  * [ ]  Required: Validate that no values are left blank.
  * [ ]  Required: Validate that all string values are less than 255 characters.
  * [ ]  Required: Validate that usernames contain only the whitelisted characters.
  * [ ]  Required: Validate that phone numbers contain only the whitelisted characters.
  * [ ]  Required: Validate that email addresses contain only whitelisted characters.
  * [ ]  Required: Add *at least 5* other validations of your choosing.
         --- Name validation for state, requiring the first letter to be capitalized
         --- Code for states is strictly a list of capitalized characters
         --- Position is required to be strictly digits
         --- Unique username
         --- Unique code
         --- Unique position 

8\. Required: Sanitization
  * [ ]  Required: All input and dynamic output should be sanitized.
  * [ ]  Required: Sanitize dynamic data for URLs
  * [ ]  Required: Sanitize dynamic data for HTML
  * [ ]  Required: Sanitize dynamic data for SQL

9\. Required: Penetration Testing
  * [ ]  Required: Verify form inputs are not vulnerable to SQLI attacks.
  * [ ]  Required: Verify query strings are not vulnerable to SQLI attacks.
  * [ ]  Required: Verify form inputs are not vulnerable to XSS attacks.
  * [ ]  Required: Verify query strings are not vulnerable to XSS attacks.

The following optional user stories were also implemented:

- [ ]  Bonus: On "public/staff/territories/show.php", display the name of the state.

- [ ]  Bonus: Validate the uniqueness of `users.username`.

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='https://github.com/kiankris/Globitek-CMS-Sanitization/blob/master/Salespeople.gif' title='Salespeople Walkthrough' width='' alt='Salespeople Walkthrough Walkthrough' />

<img src='https://github.com/kiankris/Globitek-CMS-Sanitization/blob/master/States_Territories.gif' title='States and Territories Walkthrough' width='' alt='States and Territories Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Interacting with the database was especially difficult as my queries would fail with little indication as to what went wrong. Figuring ways to optimize the queries, in order to write less code for each query and increase code reusability, was especially challenging due to the format of how the queries need to be written. For instance "INSERT" queries was made easier to write by using the "implode" php function for all of the column fields of the new item as it was already stored in an array, however it inexplicably fails to work for "UPDATE" queries which required a tedious string concatenation to work correctly

## License

    Copyright 2016 Kiankris Villagonzalo

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
