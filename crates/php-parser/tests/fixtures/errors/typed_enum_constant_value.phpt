===source===
<?php
enum E: int {
    const int A = 'a';
    const string B = 1, C = 'c';
    const ?int D = null;
    const int|string F = 1;
    const float G = 1;
    case H = 1;
}
===errors===
Cannot use string as value for class constant E::A of type int
Cannot use int as value for class constant E::B of type string
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected identifier "A", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use string as value for class constant E::A of type int in Standard input code on line 3
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
                    "name": "A",
                    "span": {
                      "start": 34,
                      "end": 35
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
                          "start": 30,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 38,
                      "end": 41
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
                    "name": "B",
                    "span": {
                      "start": 60,
                      "end": 61
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
                          "start": 53,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 59
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 75
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 67,
                      "end": 68
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
                          "start": 53,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 59
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "c"
                    },
                    "span": {
                      "start": 71,
                      "end": 74
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 75
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 91,
                      "end": 92
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
                              "start": 87,
                              "end": 90
                            }
                          }
                        },
                        "span": {
                          "start": 87,
                          "end": 90
                        }
                      }
                    },
                    "span": {
                      "start": 86,
                      "end": 90
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 95,
                      "end": 99
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 80,
                "end": 100
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 122,
                      "end": 123
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
                                "start": 111,
                                "end": 114
                              }
                            }
                          },
                          "span": {
                            "start": 111,
                            "end": 114
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
                                "start": 115,
                                "end": 121
                              }
                            }
                          },
                          "span": {
                            "start": 115,
                            "end": 121
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 111,
                      "end": 121
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 126,
                      "end": 127
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 128
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "G",
                    "span": {
                      "start": 145,
                      "end": 146
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
                          "start": 139,
                          "end": 144
                        }
                      }
                    },
                    "span": {
                      "start": 139,
                      "end": 144
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 149,
                      "end": 150
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 133,
                "end": 151
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "H",
                    "span": {
                      "start": 161,
                      "end": 162
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 165,
                      "end": 166
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 156,
                "end": 167
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 169
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 169
  }
}
