===source===
<?php
$a = &E::A->p;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '[' in Standard input code on line 2
===php_error 8.0-8.5===
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                                  "start": 12,
                                  "end": 13
                                }
                              }
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 19
                }
              },
              "by_ref": true
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
