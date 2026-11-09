===source===
<?php
$x = $GLOBALS[]::A;
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 11,
                              "end": 19
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 21
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
