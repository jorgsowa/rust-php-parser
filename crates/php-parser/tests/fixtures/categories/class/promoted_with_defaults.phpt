===source===
<?php class Foo { public function __construct(public readonly int $x, private string $y = 'default') {} }
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
                  "name": "__construct",
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
                              "start": 62,
                              "end": 65,
                              "start_line": 1,
                              "start_col": 62
                            }
                          }
                        },
                        "span": {
                          "start": 62,
                          "end": 65,
                          "start_line": 1,
                          "start_col": 62
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 68,
                        "start_line": 1,
                        "start_col": 46
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
                              "start": 78,
                              "end": 84,
                              "start_line": 1,
                              "start_col": 78
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 84,
                          "start_line": 1,
                          "start_col": 78
                        }
                      },
                      "default": {
                        "kind": {
                          "String": "default"
                        },
                        "span": {
                          "start": 90,
                          "end": 99,
                          "start_line": 1,
                          "start_col": 90
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 70,
                        "end": 99,
                        "start_line": 1,
                        "start_col": 70
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 104,
                "start_line": 1,
                "start_col": 18
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 105,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105,
    "start_line": 1,
    "start_col": 0
  }
}
