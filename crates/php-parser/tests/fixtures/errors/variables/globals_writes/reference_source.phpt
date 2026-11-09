===source===
<?php
$a = &$GLOBALS;
===errors >=8.1===
Cannot acquire reference to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  Cannot acquire reference to $GLOBALS in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
