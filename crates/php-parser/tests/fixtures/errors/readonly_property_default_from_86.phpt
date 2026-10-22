===source===
<?php
class A {
    public readonly int $a = 1;
    public readonly ?A $b = null, $c = null;
}
readonly class B {
    public array $d = [1];
}
===errors 8.5===
Readonly property cannot have default value
Readonly property cannot have default value
Readonly property cannot have default value
Readonly property cannot have default value
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 6
===php_error 8.2-8.5===
PHP Fatal error:  Readonly property A::$a cannot have default value in Standard input code on line 3
===ast >=8.5===
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 69,
                              "end": 70
                            }
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 70
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 70
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 76,
                      "end": 80
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 80
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 69,
                              "end": 70
                            }
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 70
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 70
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 87,
                      "end": 91
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 110,
              "end": 111
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 131,
                      "end": 133
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 125,
                          "end": 130
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 130
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 137,
                                "end": 138
                              }
                            }
                          },
                          "span": {
                            "start": 137,
                            "end": 138
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 136,
                      "end": 139
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 118,
                "end": 139
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 104,
        "end": 142
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 142
  }
}
