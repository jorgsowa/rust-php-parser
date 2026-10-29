===source===
<?php
C::m(...$a[]);
===errors===
Cannot use [] for reading
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
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
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
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 9,
                  "end": 10
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
                              "start": 14,
                              "end": 16
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
