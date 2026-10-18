===config===
min_php=8.3
===source===
<?php
class Foo {
    #[Route('/')]
    #[Cache]
    @invalid
    public function bar() { return 1; }

    #[Validate]
    public function baz() { return 2; }
}
===errors===
expected class member, found '@'
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 5
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
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 97,
                            "end": 98
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 99
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 101
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 139,
                      "end": 142
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 154,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 147,
                        "end": 156
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Validate"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 109,
                          "end": 117
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 109,
                        "end": 117
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 107,
                "end": 158
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 160
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 160
  }
}
