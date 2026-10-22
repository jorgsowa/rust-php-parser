===source===
<?php
class Foo {
    public (Iterator&Countable)|(ArrayAccess&Stringable) $prop;
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===ast===
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
                    "name": "prop",
                    "span": {
                      "start": 75,
                      "end": 80
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
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Iterator"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 30,
                                      "end": 38
                                    }
                                  }
                                },
                                "span": {
                                  "start": 30,
                                  "end": 38
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Countable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 39,
                                      "end": 48
                                    }
                                  }
                                },
                                "span": {
                                  "start": 39,
                                  "end": 48
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 29,
                            "end": 49
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "ArrayAccess"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 51,
                                      "end": 62
                                    }
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 62
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Stringable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 63,
                                      "end": 73
                                    }
                                  }
                                },
                                "span": {
                                  "start": 63,
                                  "end": 73
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 50,
                            "end": 74
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 29,
                      "end": 74
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}
