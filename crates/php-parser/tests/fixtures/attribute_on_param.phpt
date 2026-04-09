===source===
<?php function f(#[FromQuery] string $name) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "name",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 30,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 30
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 30
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "FromQuery"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 28,
                      "start_line": 1,
                      "start_col": 19
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 19,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 19
                  }
                }
              ],
              "span": {
                "start": 17,
                "end": 42,
                "start_line": 1,
                "start_col": 17
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
