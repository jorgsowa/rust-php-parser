===source===
<?php
unset($a, $this);
===errors===
Cannot unset $this
===php_error===
PHP Fatal error:  Cannot unset $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 12,
              "end": 14
            }
          },
          {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 16,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
