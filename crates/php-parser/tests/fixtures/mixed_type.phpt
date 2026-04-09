===source===
<?php function anything(mixed $x): mixed { return $x; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "anything",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 24
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 29,
                  "start_line": 1,
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
                "start": 24,
                "end": 32,
                "start_line": 1,
                "start_col": 24
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 50,
                    "end": 52,
                    "start_line": 1,
                    "start_col": 50
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 54,
                "start_line": 1,
                "start_col": 43
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "mixed"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 35,
                  "end": 40,
                  "start_line": 1,
                  "start_col": 35
                }
              }
            },
            "span": {
              "start": 35,
              "end": 40,
              "start_line": 1,
              "start_col": 35
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
