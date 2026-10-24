===source===
<?php
const A = B::C::D;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Dynamic class names are not allowed in compile-time class constant references
===errors >=8.0===
Dynamic class names are not allowed in compile-time class constant references
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM), expecting ';' or ',' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Dynamic class names are not allowed in compile-time class constant references in Standard input code on line 2
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
                "ClassConstAccess": {
                  "class": {
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
                  "member": {
                    "kind": {
                      "Identifier": "D"
                    },
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
