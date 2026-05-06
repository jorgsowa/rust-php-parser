===source===
<?php class Foo {
    public function bad(int ) {}
    public function good(): string { return 'ok'; }
}
===errors===
expected variable, found ')'
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
                  "name": "bad",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": null,
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
                        "end": 45
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 50
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "good",
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
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 79,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 85
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": "ok"
                          },
                          "span": {
                            "start": 95,
                            "end": 99
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 100
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 55,
                "end": 102
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "(int)", expecting "(" in Standard input code on line 2
