/* =========== */
CarifDBMS, Developed by Apurba Technologies Sdn Bhd. copyright 2013 - present.
/* =========== */

Carif Cron's bat file installation steps.

1) Add the .bat file into CarifDBMS root folder. http:\\localhost\CarifDBMS\
2) Open task scheduler by typing 'Task Scheduler' in search in Start Menu.
3) Click 'Create basic task' in left menu.
4) Insert name as 'CARIF Cron Job'
5) Insert description 'This is a cron job or CarifDBMS system: to send automated email notifications for patient's follow ups.' Click Next.
6) Select 'Daily'.
7) Set Start Date to today's date and set time to 8.00am. Click Next.
8) Select 'Start a program'. Click Next.
9) Browse .bat file in CarifDBMS folder. Click Next.
10) Check 'Open the properties dialog for this task when I click Finish'. Click Finish.
11) Check 'Run whether user is logged on or not' and 'Run with highest privileges' 
12) Select 'Conditions' tab. Uncheck all.
13) Select 'Settings' tab. Check 1st, 2nd, 4th, 5th and select 'Stop the existing instance' in the dropdown at the bottom. Click OK.
14) DONE.