===source===
<?php
outer:
goto Outer;
===errors===
'goto' to undefined label 'Outer'
===php_error===
PHP Fatal error:  'goto' to undefined label 'Outer' in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "outer",
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "Outer",
          "span": {
            "start": 18,
            "end": 23
          }
        }
      },
      "span": {
        "start": 13,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
