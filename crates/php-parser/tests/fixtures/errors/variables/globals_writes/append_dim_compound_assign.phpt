===source===
<?php
$GLOBALS[]['a'] .= 1;
===errors >=8.1===
Cannot append to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 6,
                              "end": 14
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 16
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 21
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 25,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
