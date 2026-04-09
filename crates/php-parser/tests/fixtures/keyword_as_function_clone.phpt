===source===
<?php function clone(object $object): object {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "clone",
          "params": [
            {
              "name": "object",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 27,
                      "start_line": 1,
                      "start_col": 21
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 21
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
                "start": 21,
                "end": 35,
                "start_line": 1,
                "start_col": 21
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "object"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 38,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 38
                }
              }
            },
            "span": {
              "start": 38,
              "end": 44,
              "start_line": 1,
              "start_col": 38
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
