===config===
min_php=8.4
===source===
<?php
class Foo {
    public int $x {
        abstract get { return 1; }
    }
}
===errors===
expected 'get' or 'set', found 'abstract'
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
                                  "start": 68,
                                  "end": 69
                                }
                              }
                            },
                            "span": {
                              "start": 61,
                              "end": 70
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
                        "end": 72
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
===php_error===
PHP Fatal error:  Cannot use the abstract modifier on a property hook in Standard input code on line 4
