===source===
<?php $y = #[Attr] static fn($a) => $a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "a",
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 29,
                          "end": 31,
                          "start_line": 1,
                          "start_col": 29
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 36,
                        "end": 38,
                        "start_line": 1,
                        "start_col": 36
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attr"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 17,
                            "start_line": 1,
                            "start_col": 13
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 13
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 38,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39,
    "start_line": 1,
    "start_col": 0
  }
}
