===source===
<?php
enum E: int {
    const string B = 1, C = 'c';
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant E::B of type string
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant E::B of type string
===errors >=8.3===
Cannot use int as value for class constant E::B of type string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected identifier "B", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use int as value for class constant E::B of type string in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 17
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 41,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 42
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "c"
                    },
                    "span": {
                      "start": 48,
                      "end": 51
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
