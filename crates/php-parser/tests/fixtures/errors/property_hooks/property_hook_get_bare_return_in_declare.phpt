===source===
<?php
class A {
    public int $x { get { declare(ticks=1) { return; } } }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
A method with return type must return a value
===errors >=8.4===
A method with return type must return a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  A method with return type must return a value in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "x",
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
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Declare": {
                                "directives": [
                                  [
                                    "ticks",
                                    {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 56,
                                        "end": 57
                                      }
                                    }
                                  ]
                                ],
                                "body": {
                                  "kind": {
                                    "Block": [
                                      {
                                        "kind": {
                                          "Return": null
                                        },
                                        "span": {
                                          "start": 61,
                                          "end": 68
                                        }
                                      }
                                    ]
                                  },
                                  "span": {
                                    "start": 59,
                                    "end": 70
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 42,
                              "end": 70
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 72
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 74
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
