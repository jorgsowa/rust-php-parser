===config===
min_php=8.1
max_php=8.3
===source===
<?php
class Foo {
    public function bar(int $x, string $y { return 1; }
    public function baz() { return 2; }
}
===errors===
expected ')', found '{'
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
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 42,
                              "end": 45
                            }
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 45
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
                        "start": 42,
                        "end": 48
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 50,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 56
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
                        "end": 59
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 69,
                            "end": 70
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 71
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 73
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
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 109,
                            "end": 110
                          }
                        }
                      },
                      "span": {
                        "start": 102,
                        "end": 111
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 113
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
