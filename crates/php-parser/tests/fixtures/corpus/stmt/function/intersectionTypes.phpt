===source===
<?php

class Test {
    public A&B $prop;
}

function test(A&B $a): A&B {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting variable in Standard input code on line 4
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
                      "start": 35,
                      "end": 40
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
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
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 33,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 34
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 43
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 54,
              "end": 58
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 63,
                  "end": 65
                }
              },
              "type_hint": {
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
                            "start": 59,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 60
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
                            "start": 61,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 62
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 62
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 59,
                "end": 65
              }
            }
          ],
          "body": [],
          "return_type": {
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
                        "start": 68,
                        "end": 69
                      }
                    }
                  },
                  "span": {
                    "start": 68,
                    "end": 69
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
                        "start": 70,
                        "end": 71
                      }
                    }
                  },
                  "span": {
                    "start": 70,
                    "end": 71
                  }
                }
              ]
            },
            "span": {
              "start": 68,
              "end": 71
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 45,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
