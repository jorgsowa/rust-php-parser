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
                      "name": "<error>",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 42,
                              "end": 45,
                              "start_line": 2,
                              "start_col": 24
                            }
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 45,
                          "start_line": 2,
                          "start_col": 24
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
                        "end": 46,
                        "start_line": 2,
                        "start_col": 24
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
                "end": 55,
                "start_line": 2,
                "start_col": 4
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
                          "end": 85,
                          "start_line": 3,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 85,
                      "start_line": 3,
                      "start_col": 28
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
                            "end": 99,
                            "start_line": 3,
                            "start_col": 44
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 101,
                        "start_line": 3,
                        "start_col": 37
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 55,
                "end": 103,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 104,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104,
    "start_line": 1,
    "start_col": 0
  }
}
