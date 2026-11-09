===source===
<?php
$b = &$GLOBALS[];
===errors >=8.1===
Cannot append to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 12,
                        "end": 20
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 12,
                  "end": 22
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
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
