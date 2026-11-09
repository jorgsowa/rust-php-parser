===source===
<?php
E::A->p[] = 1;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
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
                  "ArrayAccess": {
                    "array": {
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
                                    "Identifier": "A"
                                  },
                                  "span": {
                                    "start": 9,
                                    "end": 10
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 10
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 13
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
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
