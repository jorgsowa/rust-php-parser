===source===
<?php
class Test {
    const int X = 1;
    private const string Y = "a", Z = "b";
    const array ARRAY = [];
    const Foo|Bar|null FOO = null;
}
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
===errors 8.0-8.2===
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'X' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "X", expecting "=" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
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
                      "start": 33,
                      "end": 34
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
                          "start": 29,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 32
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 39
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 65,
                      "end": 66
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
                          "start": 58,
                          "end": 64
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 64
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 69,
                      "end": 72
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 82
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Z",
                    "span": {
                      "start": 74,
                      "end": 75
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
                          "start": 58,
                          "end": 64
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 64
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 78,
                      "end": 81
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 82
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "ARRAY",
                    "span": {
                      "start": 99,
                      "end": 104
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 93,
                          "end": 98
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 98
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 107,
                      "end": 109
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 87,
                "end": 110
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "FOO",
                    "span": {
                      "start": 134,
                      "end": 137
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
                                "start": 121,
                                "end": 124
                              }
                            }
                          },
                          "span": {
                            "start": 121,
                            "end": 124
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
                                "start": 125,
                                "end": 128
                              }
                            }
                          },
                          "span": {
                            "start": 125,
                            "end": 128
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
                                "start": 129,
                                "end": 133
                              }
                            }
                          },
                          "span": {
                            "start": 129,
                            "end": 133
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 121,
                      "end": 133
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 140,
                      "end": 144
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 115,
                "end": 145
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 147
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 147
  }
}
