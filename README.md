Laravel 11 App inside Docker (should be able to "run php artisan serve" as well)

before using be sure to
<ul>
<li>composer i</li>
<li>npm i</li>
<li>npm run build</li>
<li>php artisan migrate:fresh</li>
</ul>

Basic tests have been created (sorry i would have more here but new/ish to TDD).
Access via php artisan test.

Home ("/") should show a form of 5 named url inputs and a submit button with an action to "/url/submit".
if any url is invalid redirect back.

App process all valid urls and presents the Top Ten Keywords then seperately All Keywords found.
Each report is grouped for easy identification.

A link is provided to a Reports page (/reports) to view a list ofpreviously generated reports.
Each report is viewable individually from here (/reports).
