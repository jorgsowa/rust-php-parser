===source===
<?php
/**
 * @param int $x First line
 *
 * @return void
 */
function foo(int $x): void {}
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
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 74,
                      "end": 77
                    }
                  }
                },
                "span": {
                  "start": 74,
                  "end": 77
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
                "start": 74,
                "end": 80
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 83,
                  "end": 87
                }
              }
            },
            "span": {
              "start": 83,
              "end": 87
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @param int $x First line\n *\n * @return void\n */",
            "span": {
              "start": 6,
              "end": 60
            }
          }
        }
      },
      "span": {
        "start": 61,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
