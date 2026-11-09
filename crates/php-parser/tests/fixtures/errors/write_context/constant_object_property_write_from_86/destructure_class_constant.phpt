===source===
<?php
[E::A->p] = [1];
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
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
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "E"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 7,
                                            "end": 8
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 7,
                                        "end": 8
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "A"
                                      },
                                      "span": {
                                        "start": 10,
                                        "end": 11
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 7,
                                  "end": 11
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 13,
                                  "end": 14
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 15
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
                            "start": 19,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
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
