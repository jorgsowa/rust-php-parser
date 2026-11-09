===source===
<?php
E::class->p = 1;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors >=8.0===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error >=8.0===
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
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
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
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 9,
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
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
