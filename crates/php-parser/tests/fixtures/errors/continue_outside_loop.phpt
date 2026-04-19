===source===
<?php
continue;
===errors===
Cannot 'continue' 1 level
===ast===
{
  "stmts": [
    {
      "kind": {
        "Continue": null
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
===php_error===
PHP Fatal error:  'continue' not in the 'loop' or 'switch' context in Standard input code on line 2
