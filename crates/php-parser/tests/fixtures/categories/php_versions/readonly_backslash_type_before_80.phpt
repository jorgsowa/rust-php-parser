===source===
<?php
class A {
    private readonly \Closure $x;
    public readonly \Foo\Bar $y;
}
===errors 8.0===
'readonly properties' requires PHP 8.1 or higher
'readonly properties' requires PHP 8.1 or higher
===php_error 8.0===
PHP Parse error:  syntax error, unexpected fully qualified name "\Closure", expecting variable in Standard input code on line 3
===ast <=7.4===
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
                    "name": "x",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "readonly",
                          "Closure"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 28,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 79,
                      "end": 81
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "readonly",
                          "Foo",
                          "Bar"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 61,
                          "end": 78
                        }
                      }
                    },
                    "span": {
                      "start": 61,
                      "end": 78
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 81
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 84
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84
  }
}
===ast >=8.0===
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
                    "name": "x",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Closure"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 37,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 79,
                      "end": 81
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
                          "Foo",
                          "Bar"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 70,
                          "end": 78
                        }
                      }
                    },
                    "span": {
                      "start": 70,
                      "end": 78
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 81
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 84
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84
  }
}
