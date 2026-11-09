===source===
<?php
echo ($GLOBALS)[]['a'];
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
        "Echo": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 12,
                              "end": 20
                            }
                          }
                        },
                        "span": {
                          "start": 11,
                          "end": 21
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 23
                  }
                },
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 24,
                    "end": 27
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 28
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
