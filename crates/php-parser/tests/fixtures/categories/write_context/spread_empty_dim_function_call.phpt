===source===
<?php
f(...$a[]);
===errors===
cannot use [] for reading
===php_error <=8.1===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===php_error 8.2===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
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
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 15
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
