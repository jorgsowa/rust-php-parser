===source===
<?php
class Foo {
    public function bar(): int { return 1; }
    @invalid
    public function baz(): int { return 2; }
}
===errors===
expected class member, found '@'
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
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 45,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 48
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 58,
                            "end": 59
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 60
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 62
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "baz",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 103,
                          "end": 106
                        }
                      }
                    },
                    "span": {
                      "start": 103,
                      "end": 106
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 116,
                            "end": 117
                          }
                        }
                      },
                      "span": {
                        "start": 109,
                        "end": 118
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 80,
                "end": 120
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 122
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 122
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 4
