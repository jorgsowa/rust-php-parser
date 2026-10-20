===source===
<?php
class Foo {
    public int $x = 1;
    public const BAR = 2;
    @invalid
    private string $y = "hello";
    public function baz(): int { return 3; }
}
===errors >=8.3===
expected class member, found '@'
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" or "const" in Standard input code on line 5
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 5
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "x",
                    "span": {
                      "start": 33,
                      "end": 35
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
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 39
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "BAR",
                    "span": {
                      "start": 58,
                      "end": 61
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "value": {
                    "kind": {
                      "Int": 2
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
                "start": 45,
                "end": 66
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 99,
                      "end": 101
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
                          "start": 92,
                          "end": 98
                        }
                      }
                    },
                    "span": {
                      "start": 92,
                      "end": 98
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "hello"
                    },
                    "span": {
                      "start": 104,
                      "end": 111
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 111
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 133,
                      "end": 136
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 140,
                          "end": 143
                        }
                      }
                    },
                    "span": {
                      "start": 140,
                      "end": 143
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 153,
                            "end": 154
                          }
                        }
                      },
                      "span": {
                        "start": 146,
                        "end": 155
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 117,
                "end": 157
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 159
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 159
  }
}
