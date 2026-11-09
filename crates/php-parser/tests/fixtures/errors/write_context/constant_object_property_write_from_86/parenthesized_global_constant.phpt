===source===
<?php
(FOO)->p = 1;
===errors <=8.5===
Cannot use temporary expression in write context
===php_error <=8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "FOO"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 7,
                                "end": 10
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 11
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
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
