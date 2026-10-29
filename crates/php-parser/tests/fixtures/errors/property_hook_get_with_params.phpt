===source===
<?php
class Foo {
    public int $x {
        get(int $a) { return 1; }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
get hook of property Foo::$x must not have a parameter list
===errors >=8.4===
get hook of property Foo::$x must not have a parameter list
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  get hook of property Foo::$x must not have a parameter list in Standard input code on line 4
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
                    "name": "x",
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
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 32
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
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 67,
                                  "end": 68
                                }
                              }
                            },
                            "span": {
                              "start": 60,
                              "end": 69
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "a",
                            "span": {
                              "start": 54,
                              "end": 56
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 50,
                                  "end": 53
                                }
                              }
                            },
                            "span": {
                              "start": 50,
                              "end": 53
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 50,
                            "end": 56
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 71
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 77
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}
