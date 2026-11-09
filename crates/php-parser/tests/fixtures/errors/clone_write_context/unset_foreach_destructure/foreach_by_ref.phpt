===source===
<?php
foreach ($x as &(clone $a)[0]) {}
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
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 29,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 31
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 32
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 33,
                    "end": 34
                  }
                }
              }
            },
            "span": {
              "start": 22,
              "end": 35
            }
          },
          "by_ref": true,
          "by_ref_span": {
            "start": 21,
            "end": 22
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 37,
              "end": 39
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
