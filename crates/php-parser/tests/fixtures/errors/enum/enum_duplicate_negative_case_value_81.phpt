===source===
<?php
namespace N;
enum E: int {
    case A = -1;
    case B = - 1;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===errors 8.1===
Duplicate value in enum N\E for cases A and B
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 3
===php_error 8.1===
PHP Fatal error:  Duplicate value in enum N\E for cases A and B in Standard input code on line 5
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
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 24,
              "end": 25
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 27,
              "end": 30
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 47,
                            "end": 48
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 49
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 59,
                      "end": 60
                    }
                  },
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 65,
                            "end": 66
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 66
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 67
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
