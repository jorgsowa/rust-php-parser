===source===
<?php function f(mixed $x): mixed {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
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
                      "start": 17,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 17
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 17
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
                "start": 17,
                "end": 25,
                "start_line": 1,
                "start_col": 17
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "mixed"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 28,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 28
                }
              }
            },
            "span": {
              "start": 28,
              "end": 33,
              "start_line": 1,
              "start_col": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
