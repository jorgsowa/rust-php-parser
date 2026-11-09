===source===
<?php
class X {
    public A&B|C $p;
}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
expected '(' around an intersection type in a union, found '|'
===errors >=8.1===
expected '(' around an intersection type in a union, found '|'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "|", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "X",
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
                    "name": "p",
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
                                      "start": 27,
                                      "end": 28
                                    }
                                  }
                                },
                                "span": {
                                  "start": 27,
                                  "end": 28
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
                                      "start": 29,
                                      "end": 30
                                    }
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 27,
                            "end": 30
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
                                "start": 31,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 32
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 32
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
