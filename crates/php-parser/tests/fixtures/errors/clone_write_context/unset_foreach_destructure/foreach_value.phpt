===source===
<?php
foreach ($x as (clone $a)->b) {}
===errors <=8.4===
Cannot use temporary expression in write context
===errors >=8.5===
Cannot use result of built-in function in write context
===php_error <=8.4===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 31
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 33,
                    "end": 34
                  }
                }
              }
            },
            "span": {
              "start": 21,
              "end": 34
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 36,
              "end": 38
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
