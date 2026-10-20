===source===
<?php
class Foo {
    @invalid1
    public function bar(): int { return 1; }
    @invalid2
    public function baz(): int { return 2; }
    @invalid3
    public function qux(): int { return 3; }
}
===errors >=8.3===
expected class member, found '@'
expected class member, found '@'
expected class member, found '@'
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" or "const" in Standard input code on line 3
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 52,
                      "end": 55
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
                          "start": 59,
                          "end": 62
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 62
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 72,
                            "end": 73
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 74
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 36,
                "end": 76
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 111,
                      "end": 114
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
                          "start": 118,
                          "end": 121
                        }
                      }
                    },
                    "span": {
                      "start": 118,
                      "end": 121
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 131,
                            "end": 132
                          }
                        }
                      },
                      "span": {
                        "start": 124,
                        "end": 133
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 95,
                "end": 135
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "qux",
                    "span": {
                      "start": 170,
                      "end": 173
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
                          "start": 177,
                          "end": 180
                        }
                      }
                    },
                    "span": {
                      "start": 177,
                      "end": 180
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
                            "start": 190,
                            "end": 191
                          }
                        }
                      },
                      "span": {
                        "start": 183,
                        "end": 192
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 154,
                "end": 194
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 196
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 196
  }
}
