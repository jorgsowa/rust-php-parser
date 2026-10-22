===source===
<?php

class Test {
    public A|iterable|null $prop;
}

function test(A|B $a): int|false {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'false type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 13,
              "end": 17
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
                    "name": "prop",
                    "span": {
                      "start": 47,
                      "end": 52
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 31,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 32
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "iterable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 33,
                                "end": 41
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 41
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
                                "start": 42,
                                "end": 46
                              }
                            }
                          },
                          "span": {
                            "start": 42,
                            "end": 46
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 46
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 55
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 66,
              "end": 70
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 75,
                  "end": 77
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 71,
                            "end": 72
                          }
                        }
                      },
                      "span": {
                        "start": 71,
                        "end": 72
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
                            "start": 73,
                            "end": 74
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 74
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 74
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 71,
                "end": 77
              }
            }
          ],
          "body": [],
          "return_type": {
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
                        "start": 80,
                        "end": 83
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 83
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 84,
                        "end": 89
                      }
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 89
                  }
                }
              ]
            },
            "span": {
              "start": 80,
              "end": 89
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 57,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
