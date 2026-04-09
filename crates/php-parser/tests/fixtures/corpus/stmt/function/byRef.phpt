===source===
<?php

function a(&$b) {}
function &b($b) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 18,
                "end": 21,
                "start_line": 3,
                "start_col": 11
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
        "start": 7,
        "end": 25,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "b",
          "params": [
            {
              "name": "b",
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
                "start": 38,
                "end": 40,
                "start_line": 4,
                "start_col": 12
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 26,
        "end": 44,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
