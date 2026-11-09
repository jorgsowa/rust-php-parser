===source===
<?php
[OBJ->a] = [1];
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
Assignments can only happen to writable values
===errors 8.0-8.5===
Assignments can only happen to writable values
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting ']' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Fatal error:  Assignments can only happen to writable values in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "OBJ"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 7,
                                      "end": 10
                                    }
                                  }
                                },
                                "span": {
                                  "start": 7,
                                  "end": 10
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 12,
                                  "end": 13
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ]
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
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
