===config===
parse_version=8.1
===source===
<?php function foo(readonly string $x) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 28,
                      "end": 34,
                      "start_line": 1,
                      "start_col": 28
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 28
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": true,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 37,
                "start_line": 1,
                "start_col": 19
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
        "end": 41,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
