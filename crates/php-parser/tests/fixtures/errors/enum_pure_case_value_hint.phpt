===source===
<?php
enum A { case X = "x"; }
enum B { case X = 1.5; }
enum C { case X = "a" . "b"; }
enum D { case X = true; }
enum F { case X = 1 << 2; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case X of non-backed enum A must not have a value
'enums' requires PHP 8.1 or higher
Case X of non-backed enum B must not have a value
'enums' requires PHP 8.1 or higher
Case X of non-backed enum C must not have a value
'enums' requires PHP 8.1 or higher
Case X of non-backed enum D must not have a value
'enums' requires PHP 8.1 or higher
Case X of non-backed enum F must not have a value
===errors 8.1===
Case X of non-backed enum A must not have a value, try adding ": string" to the enum declaration
Case X of non-backed enum B must not have a value
Case X of non-backed enum C must not have a value, try adding ": string" to the enum declaration
Case X of non-backed enum D must not have a value
Case X of non-backed enum F must not have a value, try adding ": int" to the enum declaration
===errors >=8.2===
Case X of non-backed enum A must not have a value
Case X of non-backed enum B must not have a value
Case X of non-backed enum C must not have a value
Case X of non-backed enum D must not have a value
Case X of non-backed enum F must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'A' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "A" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Case X of non-backed enum A must not have a value, try adding ": string" to the enum declaration in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Case X of non-backed enum A must not have a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "A",
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
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "x"
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 28
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "B",
            "span": {
              "start": 36,
              "end": 37
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "value": {
                    "kind": {
                      "Float": 1.5
                    },
                    "span": {
                      "start": 49,
                      "end": 52
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 31,
        "end": 55
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "C",
            "span": {
              "start": 61,
              "end": 62
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 70,
                      "end": 71
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 74,
                            "end": 77
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 80,
                            "end": 83
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 74,
                      "end": 83
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 65,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 56,
        "end": 86
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "D",
            "span": {
              "start": 92,
              "end": 93
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 101,
                      "end": 102
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 105,
                      "end": 109
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 96,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 87,
        "end": 112
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 118,
              "end": 119
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 127,
                      "end": 128
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 131,
                            "end": 132
                          }
                        },
                        "op": "ShiftLeft",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 136,
                            "end": 137
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 131,
                      "end": 137
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 122,
                "end": 138
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 113,
        "end": 140
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 140
  }
}
