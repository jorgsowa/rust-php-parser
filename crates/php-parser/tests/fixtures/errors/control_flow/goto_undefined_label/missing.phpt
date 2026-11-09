===source===
<?php
goto missing;
===errors===
'goto' to undefined label 'missing'
===php_error===
PHP Fatal error:  'goto' to undefined label 'missing' in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Goto": {
          "name": "missing",
          "span": {
            "start": 11,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
