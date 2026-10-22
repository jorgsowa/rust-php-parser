===source===
<?php enum Status { const ?string MAYBE = null; const ?int COUNT = 0; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'typed enum constants' requires PHP 8.3 or higher
'typed enum constants' requires PHP 8.3 or higher
===errors 8.1-8.2===
'typed enum constants' requires PHP 8.3 or higher
'typed enum constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "MAYBE",
                    "span": {
                      "start": 34,
                      "end": 39
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 33
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 42,
                      "end": 46
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 47
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "COUNT",
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 55,
                              "end": 58
                            }
                          }
                        },
                        "span": {
                          "start": 55,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 58
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 67,
                      "end": 68
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
