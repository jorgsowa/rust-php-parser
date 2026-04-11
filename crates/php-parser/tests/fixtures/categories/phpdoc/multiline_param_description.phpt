===source===
<?php
/**
 * @param int $x A description that is long enough
 *   to span a second line with more detail
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
                      "start": 138,
                      "end": 141
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 141
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
                "start": 138,
                "end": 144
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
                  "start": 147,
                  "end": 151
                }
              }
            },
            "span": {
              "start": 147,
              "end": 151
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @param int $x A description that is long enough\n *   to span a second line with more detail\n * @return void\n */",
            "span": {
              "start": 6,
              "end": 124
            }
          }
        }
      },
      "span": {
        "start": 125,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}
