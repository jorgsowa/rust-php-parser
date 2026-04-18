===config===
min_php=8.4
===source===
<?php
class Foo {
    public int $x {
        get(int $a) { return 1; }
    }
}
===errors===
get hook must not have a parameter list
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
===php_error===
PHP Fatal error:  get hook of property Foo::$x must not have a parameter list in Standard input code on line 4
