===source===
<?php
isset($GLOBALS[], $a);
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
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
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 24,
                  "end": 26
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
