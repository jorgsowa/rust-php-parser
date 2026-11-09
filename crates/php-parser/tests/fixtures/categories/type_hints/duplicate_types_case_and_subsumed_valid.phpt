===source===
<?php
function f(int|string $x, ?Foo $y): (A&B)|(A&C)|null {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'null type' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===ast===
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
                "name": "x",
                "span": {
                  "start": 28,
                  "end": 30
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
                            "start": 17,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 20
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
                            "start": 21,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 27
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 30
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 32,
                "end": 39
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        },
                        "span": {
                          "start": 43,
                          "end": 44
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 45,
                              "end": 46
                            }
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 46
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 42,
                    "end": 47
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 49,
                          "end": 50
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "C"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          }
                        },
                        "span": {
                          "start": 51,
                          "end": 52
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 48,
                    "end": 53
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 54,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 58
                  }
                }
              ]
            },
            "span": {
              "start": 42,
              "end": 58
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
