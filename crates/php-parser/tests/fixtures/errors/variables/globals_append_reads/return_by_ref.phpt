===source===
<?php
function &f() { return $GLOBALS[]; }
===errors >=8.1===
Cannot append to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "GLOBALS"
                        },
                        "span": {
                          "start": 29,
                          "end": 37
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 39
                  }
                }
              },
              "span": {
                "start": 22,
                "end": 40
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
