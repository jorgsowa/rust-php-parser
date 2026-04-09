===source===
<?php function foo(int ...$nums) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "nums",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 19
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 19
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 31,
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
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
