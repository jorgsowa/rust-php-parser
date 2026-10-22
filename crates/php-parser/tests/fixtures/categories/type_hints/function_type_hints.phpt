===source===
<?php
function process(?int $x, int|string $y, Countable&Traversable $z): ?string {
    return null;
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Traversable", expecting variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "process",
            "span": {
              "start": 15,
              "end": 22
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 28,
                  "end": 30
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
                          "start": 24,
                          "end": 27
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 27
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 23,
                "end": 30
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 43,
                  "end": 45
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
                            "start": 32,
                            "end": 35
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 35
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
                            "start": 36,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 42
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 42
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 32,
                "end": 45
              }
            },
            {
              "name": {
                "name": "z",
                "span": {
                  "start": 69,
                  "end": 71
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 47,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 56
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Traversable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 57,
                            "end": 68
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 68
                      }
                    }
                  ]
                },
                "span": {
                  "start": 47,
                  "end": 68
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 47,
                "end": 71
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 95,
                    "end": 99
                  }
                }
              },
              "span": {
                "start": 88,
                "end": 100
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 75,
                      "end": 81
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 81
                }
              }
            },
            "span": {
              "start": 74,
              "end": 81
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
