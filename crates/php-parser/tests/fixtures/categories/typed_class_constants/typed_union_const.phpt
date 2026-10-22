===source===
<?php class A { const int|string Z = 1; }
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
===errors 8.0-8.2===
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '=' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "|", expecting "=" in Standard input code on line 1
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
                "ClassConst": {
                  "name": {
                    "name": "Z",
                    "span": {
                      "start": 33,
                      "end": 34
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
                                "start": 22,
                                "end": 25
                              }
                            }
                          },
                          "span": {
                            "start": 22,
                            "end": 25
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
                                "start": 26,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 32
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 22,
                      "end": 32
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
