===source===
<?php
$o->m(...$a[]);
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
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 10,
                  "end": 11
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
                              "start": 15,
                              "end": 17
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
