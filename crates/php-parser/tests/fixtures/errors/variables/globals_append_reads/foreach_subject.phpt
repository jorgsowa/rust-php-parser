===source===
<?php
foreach ($GLOBALS[] as $v) {}
===errors <=8.0===
Cannot use [] for reading
===errors >=8.1===
Cannot append to $GLOBALS
===php_error <=8.0===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "GLOBALS"
                  },
                  "span": {
                    "start": 15,
                    "end": 23
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 15,
              "end": 25
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 29,
              "end": 31
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 33,
              "end": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
