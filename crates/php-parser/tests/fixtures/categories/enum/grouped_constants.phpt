===source===
<?php
enum E {
    /** doc */
    #[A] const X = 1, Y = self::X;
    public const int P = 1, Q = 2;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'typed enum constants' requires PHP 8.3 or higher
===errors 8.1-8.2===
'typed enum constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected identifier "P", expecting "=" in Standard input code on line 5
===ast <=7.4===
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
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "P",
                    "span": {
                      "start": 86,
                      "end": 87
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 82,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** doc */",
                    "span": {
                      "start": 19,
                      "end": 29
                    }
                  }
                }
              },
              "span": {
                "start": 69,
                "end": 99
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Q",
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 82,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 97,
                      "end": 98
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 99
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101
  }
}
===ast >=8.0===
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
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 37
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** doc */",
                    "span": {
                      "start": 19,
                      "end": 29
                    }
                  }
                }
              },
              "span": {
                "start": 34,
                "end": 64
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 52,
                      "end": 53
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 56,
                                "end": 60
                              }
                            }
                          },
                          "span": {
                            "start": 56,
                            "end": 60
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "X"
                          },
                          "span": {
                            "start": 62,
                            "end": 63
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 63
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 37
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 34,
                "end": 64
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "P",
                    "span": {
                      "start": 86,
                      "end": 87
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 82,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 99
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Q",
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 82,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 97,
                      "end": 98
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 99
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101
  }
}
