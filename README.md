# For the configure file
Configure.php:

```<?php
<?php

function getConn(){
    return new mysqli("localhost", <username>, <passsword>, <username>);
}

?>
```
Each dbDev account should have one schema setup under the username.
Running the setup.sql script will create all necessary tables.

# VIS

The vis folder contains all content that will be placed into the public_html directory. Executing
```bash

mv vis/* public_html/*
```
will move all necessary files to public_html. Everything should still work as all files
referencing configure.php do so with:
```php
require_once __DIR__."/../configure.php";
```