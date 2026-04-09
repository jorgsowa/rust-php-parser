===source===
<?php
function f($s = <<<'EOT'
hello
EOT
) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "s",
              "type_hint": null,
              "default": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "hello"
                  }
                },
                "span": {
                  "start": 22,
                  "end": 40,
                  "start_line": 2,
                  "start_col": 16
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 40,
                "start_line": 2,
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
        "start": 6,
        "end": 45,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45,
    "start_line": 1,
    "start_col": 0
  }
}
