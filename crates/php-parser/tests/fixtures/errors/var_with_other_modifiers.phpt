===source===
<?php
class A {
    var static $a;
    var readonly int $b;
    var final $c;
    static var $d;
    public var $e;
    var var $f;
}
===errors===
expected variable, found 'static'
expected variable, found 'readonly'
expected variable, found 'final'
expected variable, found identifier
expected variable, found identifier
expected variable, found identifier
===php_error===
PHP Parse error:  syntax error, unexpected token "static", expecting variable in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 56,
                      "end": 58
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
                          "start": 52,
                          "end": 55
                        }
                      }
                    },
                    "span": {
                      "start": 52,
                      "end": 55
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 58
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 74,
                      "end": 76
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 76
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 93,
                      "end": 95
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "var"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 89,
                          "end": 92
                        }
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 92
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 82,
                "end": 95
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 112,
                      "end": 114
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "var"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 108,
                          "end": 111
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 111
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 101,
                "end": 114
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 128,
                      "end": 130
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "var"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 124,
                          "end": 127
                        }
                      }
                    },
                    "span": {
                      "start": 124,
                      "end": 127
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 120,
                "end": 130
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
