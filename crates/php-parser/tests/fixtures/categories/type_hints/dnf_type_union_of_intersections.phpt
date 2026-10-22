===source===
<?php function foo((Countable&Traversable)|(ArrayAccess&Stringable) $x): void {}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
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
                  "Union": [
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Countable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 29
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 30,
                                  "end": 41
                                }
                              }
                            },
                            "span": {
                              "start": 30,
                              "end": 41
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 42
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "ArrayAccess"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 44,
                                  "end": 55
                                }
                              }
                            },
                            "span": {
                              "start": 44,
                              "end": 55
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Stringable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 56,
                                  "end": 66
                                }
                              }
                            },
                            "span": {
                              "start": 56,
                              "end": 66
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 43,
                        "end": 67
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 67
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 70
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 73,
                  "end": 77
                }
              }
            },
            "span": {
              "start": 73,
              "end": 77
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
