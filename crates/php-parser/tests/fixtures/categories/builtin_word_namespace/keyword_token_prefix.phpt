===source===
<?php
function f(self\X $a, static\Y $b, null\Z $c, array\W $d) {}
===errors <=7.4===
Cannot use the static modifier on a parameter
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting variable (T_VARIABLE) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self",
                      "X"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 26
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Y"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 34,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 28,
                "end": 39
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null",
                      "Z"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 41,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 47
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 41,
                "end": 50
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 60,
                  "end": 62
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array",
                      "W"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 52,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 59
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 52,
                "end": 62
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self",
                      "X"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 26
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "static",
                      "Y"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 28,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 28,
                "end": 39
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null",
                      "Z"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 41,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 47
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 41,
                "end": 50
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 60,
                  "end": 62
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array",
                      "W"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 52,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 59
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 52,
                "end": 62
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
