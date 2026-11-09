===source===
<?php
enum E: int {
    const ?int D = null;
    const int|string F = 1;
    const float G = 1;
    case H = 1;
}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
'typed class constants' requires PHP 8.3 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 3
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
                    "name": "D",
                    "span": {
                      "start": 35,
                      "end": 36
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
                              "start": 31,
                              "end": 34
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 34
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 39,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 44
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 66,
                      "end": 67
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
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
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
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
                        }
                      ]
                    },
                    "span": {
                      "start": 55,
                      "end": 65
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 70,
                      "end": 71
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 72
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "G",
                    "span": {
                      "start": 89,
                      "end": 90
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 83,
                          "end": 88
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 88
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 77,
                "end": 95
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "H",
                    "span": {
                      "start": 105,
                      "end": 106
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 109,
                      "end": 110
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 100,
                "end": 111
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
