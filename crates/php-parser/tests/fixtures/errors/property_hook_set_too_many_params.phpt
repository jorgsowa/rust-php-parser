===config===
min_php=8.4
===source===
<?php
class Foo {
    public int $x {
        set(int $a, int $b) { }
    }
}
===errors===
set hook must have exactly one parameter
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                      "is_final": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "a",
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
                          "is_readonly": false,
                          "is_final": false,
                          "visibility": null,
                          "set_visibility": null,
                          "attributes": [],
                          "span": {
                            "start": 50,
                            "end": 56
                          }
                        },
                        {
                          "name": "b",
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
                          "is_readonly": false,
                          "is_final": false,
                          "visibility": null,
                          "set_visibility": null,
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
===php_error===
PHP Fatal error:  set hook of property Foo::$x must accept exactly one parameters in Standard input code on line 4
