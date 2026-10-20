===source===
<?php
class Foo {
    public int $x {
        set(int $a, int $b) { }
    }
}
===errors >=8.4===
set hook must have exactly one parameter
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  set hook of property Foo::$x must accept exactly one parameters in Standard input code on line 4
===ast >=8.4===
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
                      "kind": "Set",
                      "body": {
                        "Block": []
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
                        },
                        {
                          "name": {
                            "name": "b",
                            "span": {
                              "start": 62,
                              "end": 64
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
                                  "start": 58,
                                  "end": 61
                                }
                              }
                            },
                            "span": {
                              "start": 58,
                              "end": 61
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 58,
                            "end": 64
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 69
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 75
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 77
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}
