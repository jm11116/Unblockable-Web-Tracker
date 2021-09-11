This is a tracking program written in PHP by John Micallef. By installing it your webpages, it can tell you everything you can possibly know about who’s visiting your sites, such as:

* Their IP address (or the IP address of their VPN connection).
* The date and time of their visit, to the millisecond.
* Their reported browser and OS.
* Their country, state, and suburb.
* The query string they typed into the address bar.
* The URL they came from (the referrer).
* And the URL they meant to visit (if installed on 404 and 403 pages).

Because the script runs on the server and not in the browser, good luck blocking it!

This is my most well-written project to date, using everything I know about design patterns to produce code that is so readable that even non-programmers should be able to get the jist of what it does by perusing the source.

Installation:
* Put the ’tracker’ folder into your website’s home directory.
* Put the ’tracking_info’ folder in the folder that CONTAINS your website’s home directory (so a directory ABOVE public_html or www)*.
* Open up ’tracking_settings.xml’ in the ’tracking_info’ folder and put the full URL of the website you want to track on between the <website> tags.
* Create free Userstack and IPStack accounts and put their keys in between the relevant tags after that.
* Put in your desired timezone using one of the strings located on this page: https://www.php.net/manual/en/timezones.php (e.g. if you live in McMurdo in Antarctica, first off that’s amazing, and second off, you’d type in 'Antarctica/McMurdo’ between the tags. You need to be exact when typing in the string or the script will have a WTF moment.
* Then you need to specify your MySQL stuff. ‘localhost’ should be the server if your tracking script is on the same server as your website. Then you’ll need to specify your tracking database and username.
* You’ll need to create a MySQL database with the following columns with VARCHAR as the type:
    * Website
    * Date
    * Time
    * Page
    * Country
    * State
    * Suburb
    * Browser
    * OS
    * IP
    * Query
    * Referer
    * Requested
* You can put in blocked IPs between the <blocked_ips> for IPs that you don’t want to track, like your own, separated by commas.
* You can change the query string that will prevent your visits from being tracked for 30 days here as well (default is: ’no_track’, so ‘?no_track’).
* You’ll then need to include the tracker on each of your website’s page with the following code: 
```` 
<?php include “$_SERVER[‘DOCUMENT_ROOT’] . “/tracker/tracker.php; ?>
```` 
* You’ll then need to open up ‘dbp.php’ in the ’tracking_info’ folder and enter the password to your tracking database. This will be saved outside your website’s document root if you’ve followed the instructions, so it can’t be accessed by someone without server access.
* You should then be good to go. Enjoy!

Future features:
* Upgraded MySQL security.
* Option to get an email with detailed visitor information with page exclusions.
* Better path handling by using dirname($_SERVER["DOCUMENT_ROOT", 1) everywhere.

*Sorry to SHOUT but I needed some way to EMPHASIZE stuff.
