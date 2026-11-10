===source===
<?php
class C { public (A&B)&D $p; }
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
expected '|', found '&'
===errors >=8.1===
expected '|', found '&'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 2
===php_error >=8.2===
PHP Parse error:  syntax error, unexpected token "&", expecting "|" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                      "start": 31,
                      "end": 33
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
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 24,
                                      "end": 25
                                    }
                                  }
                                },
                                "span": {
                                  "start": 24,
                                  "end": 25
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
                                      "start": 26,
                                      "end": 27
                                    }
                                  }
                                },
                                "span": {
                                  "start": 26,
                                  "end": 27
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 23,
                            "end": 28
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "D"
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
                      "start": 23,
                      "end": 30
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
