===source===
<?php class A { const int X = 1; private const string Y = 'a'; const Foo|Bar|null Z = null; }
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
===errors 8.0-8.2===
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'X' (T_STRING), expecting '=' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "X", expecting "=" in Standard input code on line 1
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
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 25
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 32
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 47,
                          "end": 53
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 53
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 58,
                      "end": 61
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 62
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Z",
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 69,
                                "end": 72
                              }
                            }
                          },
                          "span": {
                            "start": 69,
                            "end": 72
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Bar"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 73,
                                "end": 76
                              }
                            }
                          },
                          "span": {
                            "start": 73,
                            "end": 76
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
                                "start": 77,
                                "end": 81
                              }
                            }
                          },
                          "span": {
                            "start": 77,
                            "end": 81
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 69,
                      "end": 81
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 86,
                      "end": 90
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
