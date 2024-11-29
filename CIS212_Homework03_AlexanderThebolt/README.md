# ClickCounter
 
How to use

- index page
- unseen page in the website
- contains comment header
- contains database login info
- automatically redirects to the login screen

- program opens to login screen
- if user has an account, sign in with username and password
- if not, click "Create an account" to register an account
- logging in only works if the username and password fields are filled and valid
- with valid info, LOGIN button will take user to the game page

- register screen
- enter a username, first name, last name, password, and the password again.
- all fields must be filled, username must be unique, and the passwords must be the same for info to be accepted.
- click "Login" to return to the login page
- with valid info, REGISTER button will take user to the game page

- game screen
- to play, rapidly click the big, grey button and try to get the highest total of clicks within 5 seconds
- when the 5 seconds are up, the big, grey button will be disabled and the SUBMIT button will be enabled
- clicking the SUBMIT button will submit the user's score
- clicking the RESTART button will allow the user to play the game again
- clicking the LOGOUT button will take the user to the login page
- clicking "here" will take the user to the high scores page
- upon submitting a score,
- if the score is successfully uploaded to the database, there will be a success alert, click the X to dismiss it
- if the score is not uploaded to the database, there will be an error alert, click the X to remove it

- scores screen
- by default, the scores will sort highest to lowest
- the score screen is divided into pages containing 5 rows each
- each row contains the clicks per second, the username of the user, the user's full name, the total clicks, and the date 
- page numbers are at the bottom, the user can select a page number or use the "previous"/"next" buttons to traverse through the pages
- the SORT BY button allows the user to select a filter to sort the scores by
- the user can sort by highest, lowest, scores submitted today, or by a user, a divider separates the usernames from the default 3 sorts
- the RETURN TO GAME button takes the user back to the game page
- if there happen to be no scores, there will be a grey alert telling the user to play the game to see a score.


Other notes

- I wanted to make the program compatible for all devices
    - mobile device screens make it a little challenging to click the big, grey button, but the website works
    - The website should be compatible for all browers (I tested edge, brave, safari, and chrome)

- I wanted to give the website a simple yet professional design
    - I made the background dark to make the pages pop.
    - I liked the idea of small app-like pages.

- Styling
    - I used Bootstrap 5 for the majority of the styling...
    - ...except to move the contents of the page into the middle-ish of the screen
    - This may cause problems for vertically-short screens to show the entire contents of the page.

- Issues?
    - Sometimes the database rejects a high score, not sure why
    - Sometimes the date of a score is wrong, not sure why
    - Sometimes the js files take a while to update to the browser, not sure why