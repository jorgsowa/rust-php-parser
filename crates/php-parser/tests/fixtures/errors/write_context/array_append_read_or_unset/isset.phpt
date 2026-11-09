===source===
<?php
isset($a[]);
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
