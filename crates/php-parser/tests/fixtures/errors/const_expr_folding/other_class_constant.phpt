===source===
<?php
const A = B::C ?? $x;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 16,
                                "end": 17
                              }
                            }
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "C"
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 26
            }
          }
        ]
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
