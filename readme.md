### Authentication usign Php

---

This Repo is get clear understading how session authentication works using `session` in php

##### PDO

---

- PHP data objects (PHP Extension).
- Lean and consistent way to access the database.

  (can be used in place of `mysqli`.

  unlike `mysqli` which only works with mysql db , `PDO` works with bunch of other db )

- works with multiple database.
- Data access layer

  (No matter what db you are using you will use same functions to run query and fetch data)

- Object oriented (works with >= php 5 )

##### Difference between require and include

---

If we can include files using the include() statement then why we need require(). Typically the require() statement operates like include().

The only difference is — the include() statement will only generate a PHP warning but allow script execution to continue if the file to be included can't be found, whereas the require() statement will generate a fatal error and stops the script execution.
