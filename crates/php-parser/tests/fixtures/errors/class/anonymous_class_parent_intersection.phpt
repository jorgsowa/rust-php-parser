===source===
<?php
class A {}
$b = new class extends A {
    function f(parent&B $x) {}
};
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type parent cannot be part of an intersection type
===errors >=8.1===
Type parent cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'B' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 4
===php_error >=8.1===
PHP Fatal error:  Type parent cannot be part of an intersection type in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          },
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 57,
                                      "end": 58
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "x",
                                        "span": {
                                          "start": 68,
                                          "end": 70
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Intersection": [
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "parent"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 59,
                                                    "end": 65
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 59,
                                                "end": 65
                                              }
                                            },
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "B"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 66,
                                                    "end": 67
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 66,
                                                "end": 67
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 59,
                                          "end": 67
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 59,
                                        "end": 70
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 48,
                                "end": 74
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 76
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 76
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 76
          }
        }
      },
      "span": {
        "start": 17,
        "end": 77
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}
