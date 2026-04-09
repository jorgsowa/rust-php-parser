===source===
<?php
function foo(...$foo = []) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "foo",
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 29,
                  "end": 31,
                  "start_line": 2,
                  "start_col": 23
                }
              },
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
                "start_line": 2,
                "start_col": 13
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
        "start_line": 2,
        "start_col": 0
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
