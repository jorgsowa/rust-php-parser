===source===
<?php
unset($GLOBALS[]['a']);
===errors <=8.0===
Cannot use [] for unsetting
===errors >=8.1===
Cannot append to $GLOBALS
===php_error <=8.0===
PHP Fatal error:  Cannot use [] for unsetting in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
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
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 23,
                    "end": 26
                  }
                }
              }
            },
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
