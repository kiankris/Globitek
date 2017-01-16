# Globitek-CMS
Time spent: 10 hours 

Project By: Kiankris Villagonzalo

## User Stories

The following **required** functionality is completed:
A user table has been created with id, firstname, lastname, email, username, and createdAt columns. The id is autoincrementing and treated as the primary key. 

A form page has been created that requires the user to input a firstname, lastname, email, and username which will submit to itself. Sanitizaton of input has been implemented for all fields using the 'htmlspecialchar' function. After submission the form will display any errors if any exist as well as the values that were inputted. In order to determine any errors the page will detect the absence of any values or that the length of any input is less than 255 characters. The first and last name must be at least 2 characters. The username must have at least 8 characters. The email must match a regex expression. 

Assuming that there were no errors the page will submit the data to the database through an sql statement in the form of "INSERT INTO 'users' (first_name, last_name, email, username) VALUES (firstname, lastname, email, username)" Afterwards the page is redirected to a success page. 

Bonus functionality that has been implemented: usernames are required to be unique.

## Video Walkthrough


## Notes

Describe any challenges encountered while building the app.

Getting the database set up was relatively difficult as it was the first one that I have ever set up and interacting with it required troubleshooting. 

## License

    Copyright [2016] [Kiankris Villagonzalo]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
