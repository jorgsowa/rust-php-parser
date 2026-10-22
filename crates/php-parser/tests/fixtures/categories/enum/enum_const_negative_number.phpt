===source===
<?php enum Numbers { const NEG_INT = -42; const NEG_FLOAT = -3.14; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Numbers' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Numbers" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Numbers",
            "span": {
              "start": 11,
              "end": 18
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "NEG_INT",
                    "span": {
                      "start": 27,
                      "end": 34
                    }
                  },
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 38,
                            "end": 40
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 41
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "NEG_FLOAT",
                    "span": {
                      "start": 48,
                      "end": 57
                    }
                  },
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Float": 3.14
                          },
                          "span": {
                            "start": 61,
                            "end": 65
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
