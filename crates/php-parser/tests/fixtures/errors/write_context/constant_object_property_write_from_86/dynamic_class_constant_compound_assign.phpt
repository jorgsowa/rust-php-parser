===source===
<?php
E::{'A'}->p .= 1;
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
Cannot use temporary expression in write context
===errors 8.3-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '(' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "->", expecting "(" in Standard input code on line 2
===php_error 8.3-8.5===
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
                        "ClassConstAccessDynamic": {
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
                              "String": "A"
                            },
                            "span": {
                              "start": 10,
                              "end": 13
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
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 21,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
