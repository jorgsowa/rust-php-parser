===source===
<?php
unset($a[]['k']);
===errors===
Cannot use [] for unsetting
===php_error===
PHP Fatal error:  Cannot use [] for unsetting in Standard input code on line 2
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
                },
                "index": {
                  "kind": {
                    "String": "k"
                  },
                  "span": {
                    "start": 17,
                    "end": 20
                  }
                }
              }
            },
            "span": {
              "start": 12,
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
