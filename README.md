Laravel 11 App inside Docker 

Using

Laravel 11 with Jetstream
Inertia (but i dont like this)
Vue3

before using be sure to
<ul>
<li>composer i</li>
<li>npm i</li>
<li>npm run build</li>
<li>php artisan migrate:fresh --seed</li>
</ul>

Basic tests have been created (sorry i would have more here but new/ish to TDD).
Access via php artisan test.

registration isnt possible login with 
<ul>
<li>test@example.com</li>
<li>pass-for-test</li>
</ul>

Tasks ("/tasks") should show a list of seeded tasks belonging to the user above.
there is a new task button at the top to open a vue modal with a form for creating a new task, validated with required for both fields.
error messages on missing field data is also present on this modal.

tasks list has 2 buttons per task, one to mark task complete, and another to delete said task.
