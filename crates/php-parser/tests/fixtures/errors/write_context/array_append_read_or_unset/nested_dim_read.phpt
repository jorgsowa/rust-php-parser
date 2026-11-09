===source===
<?php
echo $a[][0];
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
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
                          "start": 11,
                          "end": 13
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 16,
                    "end": 17
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 18
            }
          }
        ]
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
