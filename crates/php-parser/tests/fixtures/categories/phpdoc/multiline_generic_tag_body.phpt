===source===
<?php
/**
 * @custom-tag first line
 *   second line
 * @return void
 */
function foo(): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 89,
                  "end": 93
                }
              }
            },
            "span": {
              "start": 89,
              "end": 93
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @custom-tag first line\n *   second line\n * @return void\n */",
            "span": {
              "start": 6,
              "end": 72
            }
          }
        }
      },
      "span": {
        "start": 73,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
