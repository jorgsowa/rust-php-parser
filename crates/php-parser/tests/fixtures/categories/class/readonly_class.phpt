===config===
min_php=8.2
===source===
<?php readonly class Point { public function __construct(public int $x, public int $y) {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Point",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
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
                              "start": 64,
                              "end": 67,
                              "start_line": 1,
                              "start_col": 64
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 67,
                          "start_line": 1,
                          "start_col": 64
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 70,
                        "start_line": 1,
                        "start_col": 57
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 79,
                              "end": 82,
                              "start_line": 1,
                              "start_col": 79
                            }
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 82,
                          "start_line": 1,
                          "start_col": 79
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 72,
                        "end": 85,
                        "start_line": 1,
                        "start_col": 72
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 90,
                "start_line": 1,
                "start_col": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 91,
        "start_line": 1,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91,
    "start_line": 1,
    "start_col": 0
  }
}
