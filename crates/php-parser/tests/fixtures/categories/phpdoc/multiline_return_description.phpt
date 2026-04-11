===source===
<?php
/**
 * @return string The result value which
 *   can be very long and spans
 *   multiple lines
 */
function foo(): string {}
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
                  "string"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 123,
                  "end": 129
                }
              }
            },
            "span": {
              "start": 123,
              "end": 129
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @return string The result value which\n *   can be very long and spans\n *   multiple lines\n */",
            "span": {
              "start": 6,
              "end": 106
            }
          }
        }
      },
      "span": {
        "start": 107,
        "end": 132
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 132
  }
}
