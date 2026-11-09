===source===
<?php
$GLOBALS = 1;
===errors >=8.1===
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
===php_error >=8.1===
PHP Fatal error:  $GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax in Standard input code on line 2
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
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
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
