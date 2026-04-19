===source===
<?php
break;
===errors===
Cannot 'break' 1 level
===ast===
{
  "stmts": [
    {
      "kind": {
        "Break": null
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
===php_error===
PHP Fatal error:  'break' not in the 'loop' or 'switch' context in Standard input code on line 2
