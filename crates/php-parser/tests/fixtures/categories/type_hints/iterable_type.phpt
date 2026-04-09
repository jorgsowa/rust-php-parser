===source===
<?php function f(iterable $x): iterable {}
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
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 25,
                      "start_line": 1,
                      "start_col": 17
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 25,
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
                "end": 28,
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
                  "iterable"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 31,
                  "end": 39,
                  "start_line": 1,
                  "start_col": 31
                }
              }
            },
            "span": {
              "start": 31,
              "end": 39,
              "start_line": 1,
              "start_col": 31
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
