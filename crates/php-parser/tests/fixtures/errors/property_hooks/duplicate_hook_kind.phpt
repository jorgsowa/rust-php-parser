===config===
min_php=8.4
===source===
<?php
class Foo {
    public int $x {
        get { return 1; }
        get { return 2; }
    }
}
===errors===
duplicate 'get' hook
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
                                  "start": 59,
                                  "end": 60
                                }
                              }
                            },
                            "span": {
                              "start": 52,
                              "end": 61
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 63
                      }
                    },
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 85,
                                  "end": 86
                                }
                              }
                            },
                            "span": {
                              "start": 78,
                              "end": 87
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 72,
                        "end": 89
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 95
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
===php_error===
PHP Fatal error:  Cannot redeclare property hook "get" in Standard input code on line 5
