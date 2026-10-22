===source===
<?php
namespace N;
use X\Y;
class A {
    public callable|Y|B|null $a;
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
Property N\A::$a cannot have type X\Y|N\B|callable|null
===errors >=8.0===
Property N\A::$a cannot have type X\Y|N\B|callable|null
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 5
===php_error >=8.0===
PHP Fatal error:  Property N\A::$a cannot have type X\Y|N\B|callable|null in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "X",
                  "Y"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": null,
              "span": {
                "start": 23,
                "end": 26
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 27
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 34,
              "end": 35
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 67,
                      "end": 69
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "callable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 49,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 49,
                            "end": 57
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Y"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 58,
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 58,
                            "end": 59
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
                                "start": 60,
                                "end": 61
                              }
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 61
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 62,
                                "end": 66
                              }
                            }
                          },
                          "span": {
                            "start": 62,
                            "end": 66
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 49,
                      "end": 66
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
