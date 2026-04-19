===config===
min_php=8.4
===source===
<?php
class Foo {
    public int $x {
        123;
        get { return $this->x; }
    }
}
===errors===
expected 'get' or 'set', found integer
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
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 72,
                                        "end": 77
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "x"
                                      },
                                      "span": {
                                        "start": 79,
                                        "end": 80
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 72,
                                  "end": 80
                                }
                              }
                            },
                            "span": {
                              "start": 65,
                              "end": 81
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 83
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected integer "123", expecting identifier in Standard input code on line 4
