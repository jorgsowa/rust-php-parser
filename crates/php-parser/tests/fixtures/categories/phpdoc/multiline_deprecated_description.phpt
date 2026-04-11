===source===
<?php
/**
 * @deprecated Use newMethod() instead
 *   because this one is broken
 */
function oldMethod(): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "oldMethod",
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
                  "start": 107,
                  "end": 111
                }
              }
            },
            "span": {
              "start": 107,
              "end": 111
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @deprecated Use newMethod() instead\n *   because this one is broken\n */",
            "span": {
              "start": 6,
              "end": 84
            }
          }
        }
      },
      "span": {
        "start": 85,
        "end": 114
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 114
  }
}
